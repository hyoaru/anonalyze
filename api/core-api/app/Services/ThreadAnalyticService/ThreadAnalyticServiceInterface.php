<?php

namespace App\Services\ThreadAnalyticService;

interface ThreadAnalyticServiceInterface
{
    public function getThreadAnalyticMetrics(int $threadId): array;
}
