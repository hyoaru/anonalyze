<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPredictedEmotions\StorePostPredictedEmotionRequest;
use App\Http\Requests\PostPredictedEmotions\UpdatePostPredictedEmotionRequest;
use App\Models\PostPredictedEmotion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostPredictedEmotionController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: [
                'index',
                'show'
            ])
        ];
    }
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
        $validatedData = $request->validated();
        $postPredictedEmotion = PostPredictedEmotion::create($validatedData);
        $response = ['data' => $postPredictedEmotion];
        return $response;
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
        $this->authorize('update', $postPredictedEmotion);
        $validatedData = $request->validated();
        $postPredictedEmotion->update($validatedData);
        $response = ['data' => $postPredictedEmotion];
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPredictedEmotion $postPredictedEmotion)
    {
        $this->authorize('delete', $postPredictedEmotion);
        $postPredictedEmotion->delete();
        $response = ['data' => $postPredictedEmotion];
        return $response;
    }
}
