<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostPredictedEmotion\StorePostPredictedEmotionRequest;
use App\Http\Requests\Posts\PostPredictedEmotion\UpdatePostPredictedEmotionRequest;
use App\Models\Posts\PostPredictedEmotion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostPredictedEmotionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostPredictedEmotionRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(PostPredictedEmotion $postPredictedEmotion) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostPredictedEmotionRequest $request, PostPredictedEmotion $postPredictedEmotion) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPredictedEmotion $postPredictedEmotion) {}
}
