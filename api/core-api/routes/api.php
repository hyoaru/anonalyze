<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\SentimentController;
use App\Http\Controllers\Posts\PostAnalyticController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\PostPredictedEmotionController;
use App\Http\Controllers\Posts\PostPredictedSentimentController;
use App\Http\Controllers\Posts\PostTransactionController;
use App\Http\Controllers\Threads\ThreadAnalyticController;
use App\Http\Controllers\Threads\ThreadController;
use App\Http\Controllers\Threads\ThreadExtractedConceptGroupController;
use App\Http\Controllers\Threads\ThreadSummaryController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    Route::post('/sign-in', [AuthController::class, 'sign_in']);
    Route::post('/sign-up', [AuthController::class, 'sign_up']);
    Route::post('/sign-out', [AuthController::class, 'sign_out'])->middleware('auth:sanctum');
});


Route::apiResource('sentiments', SentimentController::class);
Route::apiResource('emotions', EmotionController::class);

Route::apiResource('threads', ThreadController::class)->except(['index']);
Route::apiResource('thread-summaries', ThreadSummaryController::class);
Route::apiResource('thread-extracted-concept-groups', ThreadExtractedConceptGroupController::class);
Route::apiResource('thread-analytics', ThreadAnalyticController::class);

Route::apiResource('posts', PostController::class)->only(['store', 'show', 'destroy']);
Route::apiResource('post-predicted-sentiments', PostPredictedSentimentController::class);
Route::apiResource('post-predicted-emotions', PostPredictedEmotionController::class);
Route::apiResource('post-analytics', PostAnalyticController::class);


Route::prefix('/post-transactions')->group(function () {
    Route::post('/', [PostTransactionController::class, 'createPost']);
});