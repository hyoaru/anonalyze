<?php

namespace App\Repositories\ThreadSummaryRepository;

use App\Models\Threads\ThreadSummary;

interface ThreadSummaryRepositoryInterface
{
    public function new(): ThreadSummary;

    public function upsertSummaryBuffer(ThreadSummary $threadSummary, string $text): ThreadSummary;

    public function updateSummary(ThreadSummary $threadSummary, string $text): ThreadSummary;
}
