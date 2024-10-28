<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\ThreadAnalytic\StoreThreadAnalyticRequest;
use App\Http\Requests\Threads\ThreadAnalytic\UpdateThreadAnalyticRequest;
use App\Models\Threads\Thread;
use App\Models\Threads\ThreadAnalytic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ThreadAnalyticController extends Controller
{
    use AuthorizesRequests;

    public function index() {}

    public function store(StoreThreadAnalyticRequest $request) {}

    /**
     * @OA\Get(
     *     path="/api/thread-analytics/{id}",
     *     tags={"Thread analytics"},
     *     summary="Retrieve a thread analytic by its ID",
     *     description="Get a thread analytic along with its analytics, sentiment, and emotion data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread analytic to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the thread analytic and its analytics",
     *         @OA\JsonContent(ref="#/components/schemas/ThreadAnalytic")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Thread analytic not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show(ThreadAnalytic $threadAnalytic)
    {
        $response = $threadAnalytic->load([
            'threadExtractedConceptGroup',
            'threadExtractedConceptGroup.threadExtractedConcepts',
        ]);

        return $response;
    }

    public function update(UpdateThreadAnalyticRequest $request, ThreadAnalytic $threadAnalytic) {}

    /**
     * @OA\Delete(
     *     path="/api/thread-analytics/{id}",
     *     tags={"Thread analytics"},
     *     summary="Delete a thread analytic by its ID",
     *     description="Deletes a thread analytic and returns its analytics before deletion",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread analytic to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Thread analytic deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ThreadAnalytic")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Thread analytic not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function destroy(ThreadAnalytic $threadAnalytic)
    {
        $this->authorize('delete', $threadAnalytic);
        $threadAnalytic->delete();
        $response = $threadAnalytic;
        return $response;
    }

    public function getThreadAnalyticMetrics(Thread $thread)
    {
        $thread = $thread->load([
            'posts',
            'posts.postAnalytic',
            'posts.postAnalytic.postPredictedSentiment',
            'posts.postAnalytic.postPredictedSentiment.sentiment',
            'posts.postAnalytic.postPredictedEmotion',
            'posts.postAnalytic.postPredictedEmotion.emotion',
            'threadSummary',
            'threadAnalytic',
            'threadAnalytic.threadExtractedConceptGroup',
            'threadAnalytic.threadExtractedConceptGroup.threadExtractedConcepts',
        ]);

        // 1. Total Response
        $totalResponse = $thread->posts->count();

        // 2. Key Concept
        $keyConcept = $thread->threadAnalytic
            ->threadExtractedConceptGroup
            ->threadExtractedConcepts
            ->sortByDesc('significance_score')
            ->first();
            // ->concept ?? 'No concept available';

        return $keyConcept;

        // 3. Leading Sentiment
        $sentimentCounts = [];
        $thread->posts->each(function ($post) use (&$sentimentCounts) {
            $sentiment = $post->postAnalytic->postPredictedSentiment->sentiment->class ?? null;
            $probability = $post->postAnalytic->postPredictedSentiment->probability ?? 0;
            if ($sentiment) {
                $sentimentCounts[$sentiment] = ($sentimentCounts[$sentiment] ?? 0) + $probability;
            }
        });

        $leadingSentiment = collect($sentimentCounts)->sortDesc()->keys()->first();

        // 4. Leading Emotion
        $emotionCounts = [];
        $thread->posts->each(function ($post) use (&$emotionCounts) {
            $emotion = $post->postAnalytic->postPredictedEmotion->emotion->class ?? null;
            $probability = $post->postAnalytic->postPredictedEmotion->probability ?? 0;
            if ($emotion) {
                $emotionCounts[$emotion] = ($emotionCounts[$emotion] ?? 0) + $probability;
            }
        });

        $leadingEmotion = collect($emotionCounts)->sortDesc()->keys()->first();

        // 5. Sentiment Ratio
        $sentimentTotals = collect($sentimentCounts)->sum();
        $sentimentRatio = collect($sentimentCounts)->map(function ($count) use ($sentimentTotals) {
            return $count / ($sentimentTotals ?: 1); // Avoid division by zero
        });
    }
}
