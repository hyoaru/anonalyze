<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPredictedEmotions\StorePostPredictedEmotionRequest;
use App\Http\Requests\PostPredictedEmotions\UpdatePostPredictedEmotionRequest;
use App\Models\PostPredictedEmotion;

class PostPredictedEmotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['data' => PostPredictedEmotion::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostPredictedEmotionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PostPredictedEmotion $postPredictedEmotion)
    {
        $response = ['data' => $postPredictedEmotion];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostPredictedEmotionRequest $request, PostPredictedEmotion $postPredictedEmotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPredictedEmotion $postPredictedEmotion)
    {
        //
    }
}
