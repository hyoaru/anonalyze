<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\SentimentController;
use App\Http\Controllers\Posts\PostAnalyticController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Threads\ThreadAnalyticController;
use App\Http\Controllers\Threads\ThreadController;
use App\Http\Controllers\Threads\ThreadSummaryController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    Route::post('/sign-in', [AuthController::class, 'signIn']);
    Route::post('/sign-up', [AuthController::class, 'signUp']);
    Route::post('/sign-out', [AuthController::class, 'signOut']);
});


Route::apiResource('sentiments', SentimentController::class);
Route::apiResource('emotions', EmotionController::class);

Route::apiResource('threads', ThreadController::class)->except(['index']);
Route::apiResource('thread-summaries', ThreadSummaryController::class)->only(['show']);
Route::apiResource('thread-analytics', ThreadAnalyticController::class)->only(['show']);

Route::apiResource('posts', PostController::class)->only(['store', 'show', 'destroy']);
Route::apiResource('post-analytics', PostAnalyticController::class)->only(['show']);