<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sentiments\StoreSentimentRequest;
use App\Http\Requests\Sentiments\UpdateSentimentRequest;
use App\Models\Sentiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SentimentController extends Controller implements HasMiddleware
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
        $response = ['data' => Sentiment::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSentimentRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Sentiment $sentiment)
    {
        $response = ['data' => $sentiment];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSentimentRequest $request, Sentiment $sentiment) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentiment $sentiment) {}
}
