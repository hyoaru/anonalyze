<?php

namespace App\Repositories\ThreadSummaryRepository;

use App\Models\Threads\ThreadSummary;

class ThreadSummaryRepository implements ThreadSummaryRepositoryInterface
{
    public function new(): ThreadSummary
    {
        $threadSummary = new ThreadSummary;

        return $threadSummary;
    }

    public function upsertSummaryBuffer(ThreadSummary $threadSummary, string $text): ThreadSummary
    {
        $threadSummary->summary_buffer .= $text;
        $threadSummary->save();

        return $threadSummary;
    }

    public function updateSummary(ThreadSummary $threadSummary, string $text): ThreadSummary
    {
        $threadSummary->summary = $text;
        $threadSummary->save();

        return $threadSummary;
    }
}
