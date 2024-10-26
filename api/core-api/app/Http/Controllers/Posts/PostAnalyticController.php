<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostAnalytic\StorePostAnalyticRequest;
use App\Http\Requests\Posts\PostAnalytic\UpdatePostAnalyticRequest;
use App\Models\Posts\PostAnalytic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostAnalyticController extends Controller
{
    use AuthorizesRequests;


    public function index() {}
  
    public function store(StorePostAnalyticRequest $request) {}

    /**
     * @OA\Get(
     *     path="/api/post-analytics/{id}",
     *     tags={"Post analytics"},
     *     summary="Retrieve a post analytic by its ID",
     *     description="Get a post analytic along with its sentiment and emotion data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post analytic to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the post analytic",
     *         @OA\JsonContent(ref="#/components/schemas/PostAnalytic")
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
    public function show(PostAnalytic $postAnalytic)
    {
        $data = $postAnalytic->load(['postPredictedSentiment', 'postPredictedEmotion']);
        return response()->json(200, $data);
    }

    public function update(UpdatePostAnalyticRequest $request, PostAnalytic $postAnalytic) {}

    public function destroy(PostAnalytic $postAnalytic) {}
}
