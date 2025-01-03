<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\Post\GetPostsByThreadIdRequest;
use App\Http\Requests\Posts\Post\StorePostRequest;
use App\Http\Requests\Posts\Post\UpdatePostRequest;
use App\Models\Posts\Post;
use App\Models\Threads\Thread;
use App\Services\PostService\PostServiceInterface;
use App\Services\ThreadExtractedConceptGroupService\ThreadExtractedConceptGroupServiceInterface;
use App\Services\ThreadSummaryService\ThreadSummaryServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PostController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    protected PostServiceInterface $postService;

    protected ThreadSummaryServiceInterface $threadSummaryService;

    protected ThreadExtractedConceptGroupServiceInterface $threadExtractedConceptGroupService;

    public function __construct(
        PostServiceInterface $postService,
        ThreadExtractedConceptGroupServiceInterface $threadExtractedConceptGroupService,
        ThreadSummaryServiceInterface $threadSummaryService
    ) {
        $this->postService = $postService;
        $this->threadExtractedConceptGroupService = $threadExtractedConceptGroupService;
        $this->threadSummaryService = $threadSummaryService;
    }

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: [
                'destroy',
                'getPostsByThreadId',
            ]),
        ];
    }

    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Create a new post",
     *     description="Stores a newly created post",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StorePostRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Post created successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Failed to create post"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();
        $postParams = ['content' => $validatedData['content']];

        DB::beginTransaction();
        try {
            // Validate if thread from `thread_id` exists
            $thread = Thread::findOrFail($validatedData['thread_id']);

            // Create new post
            $post = $this->postService->new(
                thread: $thread,
                postParams: $postParams,
            );

            // Update thread's key concepts
            $threadExtractedConceptGroup = $thread->threadAnalytic->threadExtractedConceptGroup;
            $this->threadExtractedConceptGroupService->updateConcepts(
                threadExtractedConceptGroup: $threadExtractedConceptGroup,
            );

            // Upsert post to summary buffer
            $threadSummary = $thread->threadSummary;
            $this->threadSummaryService->upsertSummaryBuffer(
                threadSummary: $threadSummary,
                post: $post,
            );

            // Update thread summary
            $threadSummary = $this->threadSummaryService->updateSummary(
                threadSummary: $threadSummary,
            );

            DB::commit();

            $data = $post->load([
                'postAnalytic',
                'postAnalytic.postPredictedSentiment',
                'postAnalytic.postPredictedSentiment.sentiment',
                'postAnalytic.postPredictedEmotion',
                'postAnalytic.postPredictedEmotion.emotion',
            ]);

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, 'Failed to create post. '.$th->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Retrieve a post by its ID",
     *     description="Get a post along with its analytics, sentiment, and emotion data",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post to retrieve",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the post and its analytics",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show(Post $post)
    {
        $data = $post->load([
            'postAnalytic',
            'postAnalytic.postPredictedSentiment',
            'postAnalytic.postPredictedSentiment.sentiment',
            'postAnalytic.postPredictedEmotion',
            'postAnalytic.postPredictedEmotion.emotion',
        ]);

        return response()->json($data, 200);
    }

    public function update(UpdatePostRequest $request, Post $post) {}

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Delete a post by its ID",
     *     description="Deletes a post and returns its analytics before deletion",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post to delete",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        $data = $post->load([
            'postAnalytic',
            'postAnalytic.postPredictedSentiment',
            'postAnalytic.postPredictedSentiment.sentiment',
            'postAnalytic.postPredictedEmotion',
            'postAnalytic.postPredictedEmotion.emotion',
        ]);

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/posts/by-thread-id",
     *     tags={"Posts"},
     *     summary="Retrieve posts by thread ID",
     *     description="Get all posts associated with a given thread ID along with analytics, sentiment, and emotion data",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/GetPostsByThreadIdRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of posts for the specified thread",
     *
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Thread or posts not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function getPostsByThreadId(GetPostsByThreadIdRequest $request)
    {
        $threadId = $request->validated()['thread_id'];
        $this->authorize('getPostsByThreadId', [Post::class, $threadId]);
        $data = Post::where('thread_id', $threadId)
            ->with([
                'postAnalytic',
                'postAnalytic.postPredictedSentiment',
                'postAnalytic.postPredictedSentiment.sentiment',
                'postAnalytic.postPredictedEmotion',
                'postAnalytic.postPredictedEmotion.emotion',
            ])
            ->get();

        return response()->json($data, 200);
    }
}
