<?php

namespace App\Repositories\ThreadAnalyticRepository;

use App\Models\Threads\Thread;
use App\Models\Threads\ThreadAnalytic;
use Illuminate\Database\Eloquent\Collection;

class ThreadAnalyticRepository implements ThreadAnalyticRepositoryInterface
{
    public function new(): ThreadAnalytic
    {
        return new ThreadAnalytic;
    }

    public function getAll(): Collection
    {
        return ThreadAnalytic::all();
    }

    public function getById(int $id): ?ThreadAnalytic
    {
        return ThreadAnalytic::find($id);
    }

    public function getThreadResponseCount(int $threadId): int
    {
        return Thread::find($threadId)
            ->posts
            ->count();
    }

    public function getThreadKeyConcept(int $threadId): ?string
    {
        return Thread::find($threadId)
            ->threadAnalytic
            ->threadExtractedConceptGroup
            ->threadExtractedConcepts
            ->sortByDesc('significance_score')
            ->first()
            ->concept ?? null;
    }

    public function getThreadSentimentCountMap(int $threadId): array
    {
        return Thread::find($threadId)
            ->posts
            ->map(fn ($post) => $post->postAnalytic->postPredictedSentiment->sentiment->class ?? null)
            ->groupBy(fn ($sentiment) => $sentiment)
            ->map(fn ($group, $sentiment) => [$sentiment => $group->count()])
            ->collapse()
            ->toArray();
    }

    public function getThreadLeadingSentiment(int $threadId): ?string
    {
        return collect(self::getThreadSentimentCountMap($threadId))->sortDesc()->keys()->first();
    }

    public function getThreadEmotionCountMap(int $threadId): array
    {
        return Thread::find($threadId)
            ->posts
            ->map(fn ($post) => $post->postAnalytic->postPredictedEmotion->emotion->class ?? null)
            ->groupBy(fn ($emotion) => $emotion)
            ->map(fn ($group, $emotion) => [$emotion => $group->count()])
            ->collapse()
            ->toArray();
    }

    public function getThreadLeadingEmotion(int $threadId): ?string
    {
        return collect(self::getThreadEmotionCountMap($threadId))->sortDesc()->keys()->first();
    }

    public function getThreadSentimentRatio(int $threadId): ?array
    {
        $sentimentCounts = self::getThreadSentimentCountMap($threadId);
        $sentimentTotals = collect($sentimentCounts)->sum();

        return collect($sentimentCounts)->isEmpty()
            ? null
            : collect($sentimentCounts)->map(function ($count) use ($sentimentTotals) {
                return $count / ($sentimentTotals ?: 1);
            })->toArray();
    }

    public function getThreadAnalyticMetrics(int $threadId): array
    {

        $totalResponse = self::getThreadResponseCount($threadId);
        $keyConcept = self::getThreadKeyConcept($threadId);
        $leadingSentiment = self::getThreadLeadingSentiment($threadId);
        $leadingEmotion = self::getThreadLeadingEmotion($threadId);
        $sentimentRatio = self::getThreadSentimentRatio($threadId);

        return [
            'total_response' => $totalResponse,
            'key_concept' => $keyConcept,
            'leading_sentiment' => $leadingSentiment,
            'leading_emotion' => $leadingEmotion,
            'sentiment_ratio' => $sentimentRatio,
        ];
    }
}
