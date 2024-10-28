<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\SentimentController;
use App\Http\Controllers\Posts\PostAnalyticController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Threads\ThreadAnalyticController;
use App\Http\Controllers\Threads\ThreadController;
use App\Http\Controllers\Threads\ThreadSummaryController;
use App\Models\Threads\ThreadAnalytic;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('/sign-in', [AuthController::class, 'signIn']);
    Route::post('/sign-up', [AuthController::class, 'signUp']);
    Route::post('/sign-out', [AuthController::class, 'signOut']);
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('/email/resend-verification', [AuthController::class, 'sendEmailVerification'])->name('verification.send');   
});

Route::prefix('/account')->group(function () {
    Route::get('/', [AccountController::class, 'getAccountInformation']);
    Route::post('/update-information', [AccountController::class, 'updateAccountInformation']);
    Route::post('/update-password', [AccountController::class, 'updatePassword']);
    Route::post('/update-email', [AccountController::class, 'updateEmail']);
});

Route::apiResource('sentiments', SentimentController::class)->only(['index', 'show']);
Route::apiResource('emotions', EmotionController::class)->only(['index', 'show']);

Route::apiResource('threads', ThreadController::class);
Route::get('/threads/{thread}/thread-analytics/metrics', [ThreadAnalyticController::class, 'getThreadAnalyticMetrics']);
Route::apiResource('thread-summaries', ThreadSummaryController::class)->only(['show']);
Route::apiResource('thread-analytics', ThreadAnalyticController::class)->only(['show']);

Route::apiResource('posts', PostController::class)->only(['store', 'show', 'destroy']);
Route::apiResource('post-analytics', PostAnalyticController::class)->only(['show']);