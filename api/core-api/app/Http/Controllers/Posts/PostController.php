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
     *     path="/posts",
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
     *         @OA\JsonContent(ref="#/components/schemas/Post")
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
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Get a specific post",
     *     description="Returns the details of a specific post",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
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
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Delete a specific post",
     *     description="Removes a post from storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
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
