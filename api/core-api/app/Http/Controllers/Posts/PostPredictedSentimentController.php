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
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostPredictedSentimentRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(PostPredictedSentiment $postPredictedSentiment) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostPredictedSentimentRequest $request, PostPredictedSentiment $postPredictedSentiment) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPredictedSentiment $postPredictedSentiment) {}
}
