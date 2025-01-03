<?php

namespace App\Services\ThreadSummaryService;

use App\Models\Posts\Post;
use App\Models\Threads\ThreadSummary;

interface ThreadSummaryServiceInterface
{
    public function upsertSummaryBuffer(ThreadSummary $threadSummary, Post $post): ThreadSummary;

    public function updateSummary(ThreadSummary $threadSummary): ThreadSummary;
}
