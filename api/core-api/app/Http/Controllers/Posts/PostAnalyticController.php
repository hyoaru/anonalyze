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

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostAnalyticRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(PostAnalytic $postAnalytic)
    {
        $response = ['data' => $postAnalytic->load(['postPredictedSentiment', 'postPredictedEmotion'])];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostAnalyticRequest $request, PostAnalytic $postAnalytic) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostAnalytic $postAnalytic) {}
}
