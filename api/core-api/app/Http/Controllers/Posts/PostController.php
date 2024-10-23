<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\Post\StorePostRequest;
use App\Http\Requests\Posts\Post\UpdatePostRequest;
use App\Models\Posts\Post;
use App\Services\PostService;
use App\Services\ThreadService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PostController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: [
                'destroy'
            ])
        ];
    }

    public function index() {}

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Create a new post",
     *     description="Stores a newly created post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StorePostRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/StorePostResponse")
     *     ),
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
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $post = PostService::createPost($validatedData);

            $thread = $post->thread;
            ThreadService::updateThreadExtractedConcepts($thread);

            DB::commit();

            $data = ['data' => $post->load([
                'postAnalytic',
                'postAnalytic.postPredictedSentiment',
                'postAnalytic.postPredictedSentiment.sentiment',
                'postAnalytic.postPredictedEmotion',
                'postAnalytic.postPredictedEmotion.emotion',
            ])];

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, "Failed to create post. " . $th->getMessage());
        }
    }


    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Retrieve a post by its ID",
     *     description="Get a post along with its analytics, sentiment, and emotion data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the post and its analytics",
     *         @OA\JsonContent(ref="#/components/schemas/ShowPostResponse")
     *     ),
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
        $data = ['data' => $post->load([
            'postAnalytic',
            'postAnalytic.postPredictedSentiment',
            'postAnalytic.postPredictedSentiment.sentiment',
            'postAnalytic.postPredictedEmotion',
            'postAnalytic.postPredictedEmotion.emotion',
        ])];

        return response()->json($data, 200);
    }

    public function update(UpdatePostRequest $request, Post $post) {}


    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Delete a post by its ID",
     *     description="Deletes a post and returns its analytics before deletion",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/DestroyPostResponse")
     *     ),
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

        $data = ['data' => $post->load([
            'postAnalytic',
            'postAnalytic.postPredictedSentiment',
            'postAnalytic.postPredictedSentiment.sentiment',
            'postAnalytic.postPredictedEmotion',
            'postAnalytic.postPredictedEmotion.emotion',
        ])];

        return response()->json($data, 200);
    }
}
