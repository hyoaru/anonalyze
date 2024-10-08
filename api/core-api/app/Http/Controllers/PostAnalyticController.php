<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostAnalyticRequest;
use App\Http\Requests\UpdatePostAnalyticRequest;
use App\Models\PostAnalytic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostAnalyticController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware() {
        return [
            new Middleware('auth:sanctum', except: [
                'index', 'show'
            ])
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['data' => PostAnalytic::with(['postPredictedSentiment', 'postPredictedEmotion'])->get()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostAnalyticRequest $request)
    {
        //
    }

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
    public function update(UpdatePostAnalyticRequest $request, PostAnalytic $postAnalytic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostAnalytic $postAnalytic)
    {
        //
    }
}
