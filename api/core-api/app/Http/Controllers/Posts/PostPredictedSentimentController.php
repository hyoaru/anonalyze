<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostPredictedSentiment\StorePostPredictedSentimentRequest;
use App\Http\Requests\Posts\PostPredictedSentiment\UpdatePostPredictedSentimentRequest;
use App\Models\Posts\PostPredictedSentiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostPredictedSentimentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['data' => PostPredictedSentiment::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostPredictedSentimentRequest $request)
    {
        $validatedData = $request->validated();
        $postPredictedSentiment = PostPredictedSentiment::create($validatedData);
        $response = ['data' => $postPredictedSentiment];
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(PostPredictedSentiment $postPredictedSentiment)
    {
        $response = ['data' => $postPredictedSentiment];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostPredictedSentimentRequest $request, PostPredictedSentiment $postPredictedSentiment)
    {
        $this->authorize('update', $postPredictedSentiment);

        $validatedData = $request->validated();
        $postPredictedSentiment->update($validatedData);
        $response = ['data' => $postPredictedSentiment];
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPredictedSentiment $postPredictedSentiment)
    {
        $this->authorize('delete', $postPredictedSentiment);

        $postPredictedSentiment->delete();
        $response = ['data' => $postPredictedSentiment];
        return $response;
    }
}
