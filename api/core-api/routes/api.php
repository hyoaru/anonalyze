<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPredictedEmotionController;
use App\Http\Controllers\PostPredictedSentimentController;
use App\Http\Controllers\SentimentController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ThreadSummaryController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    Route::post('/sign-in', [AuthController::class, 'sign_in']);
    Route::post('/sign-up', [AuthController::class, 'sign_up']);
    Route::post('/sign-out', [AuthController::class, 'sign_out'])->middleware('auth:sanctum');
});


Route::apiResource('threads', ThreadController::class);
Route::apiResource('thread-summaries', ThreadSummaryController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('emotions', EmotionController::class);
Route::apiResource('sentiments', SentimentController::class);
Route::apiResource('post-predicted-sentiments', PostPredictedSentimentController::class);
Route::apiResource('post-predicted-emotions', PostPredictedEmotionController::class);