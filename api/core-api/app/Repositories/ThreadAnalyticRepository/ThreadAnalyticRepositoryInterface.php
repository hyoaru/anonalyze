<?php

namespace App\Repositories\ThreadAnalyticRepository;

use App\Models\Threads\ThreadAnalytic;
use Illuminate\Database\Eloquent\Collection;

interface ThreadAnalyticRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $threadId): ?ThreadAnalytic;

    public function getThreadResponseCount(int $threadId): int;

    public function getThreadKeyConcept(int $threadId): ?string;

    public function getThreadSentimentCountMap(int $threadId): array;

    public function getThreadLeadingSentiment(int $threadId): ?string;

    public function getThreadEmotionCountMap(int $threadId): array;

    public function getThreadLeadingEmotion(int $threadId): ?string;

    public function getThreadSentimentRatio(int $threadId): ?array;

    public function getThreadAnalyticMetrics(int $threadId): array;
}
