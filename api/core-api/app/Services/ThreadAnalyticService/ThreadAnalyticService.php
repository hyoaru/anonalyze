<?php

namespace App\Services\ThreadAnalyticService;

use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepositoryInterface;

class ThreadAnalyticService implements ThreadAnalyticServiceInterface
{
    protected ThreadAnalyticRepositoryInterface $threadAnalyticRepository;

    public function __construct(ThreadAnalyticRepositoryInterface $threadAnalyticRepository)
    {
        $this->threadAnalyticRepository = $threadAnalyticRepository;
    }

    public function getThreadAnalyticMetrics(int $threadId): array
    {
        return $this->threadAnalyticRepository->getThreadAnalyticMetrics($threadId);
    }
}
