<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPredictedSentiments\StorePostPredictedSentimentRequest;
use App\Http\Requests\PostPredictedSentiments\UpdatePostPredictedSentimentRequest;
use App\Models\PostPredictedSentiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostPredictedSentimentController extends Controller implements HasMiddleware
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
        $response = ['data' => PostPredictedSentiment::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostPredictedSentimentRequest $request)
    {
        //   
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPredictedSentiment $postPredictedSentiment)
    {
        //
    }
}
