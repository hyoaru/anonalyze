<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emotions\StoreEmotionRequest;
use App\Http\Requests\Emotions\UpdateEmotionRequest;
use App\Models\Emotion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EmotionController extends Controller implements HasMiddleware
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
        $response = ['data' => Emotion::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmotionRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Emotion $emotion)
    {
        $response = ['data' => $emotion];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmotionRequest $request, Emotion $emotion) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emotion $emotion) {}
}
