<?php

namespace App\Services\ThreadSummaryService;

use App\Models\Posts\Post;
use App\Models\Threads\ThreadSummary;
use App\Repositories\MachineLearning\SummarizationRepository\SummarizationRepositoryInterface;
use App\Repositories\ThreadSummaryRepository\ThreadSummaryRepositoryInterface;

class ThreadSummaryService implements ThreadSummaryServiceInterface
{
    protected ThreadSummaryRepositoryInterface $threadSummaryRepository;

    protected SummarizationRepositoryInterface $summarizationRepository;

    public function __construct(
        ThreadSummaryRepositoryInterface $threadSummaryRepository,
        SummarizationRepositoryInterface $summarizationRepository
    ) {
        $this->threadSummaryRepository = $threadSummaryRepository;
        $this->summarizationRepository = $summarizationRepository;
    }

    public function upsertSummaryBuffer(ThreadSummary $threadSummary, Post $post): ThreadSummary
    {
        // Get the sentiment class of the post and make a buffer fragment
        $postSentiment = $post->postAnalytic->postPredictedSentiment->sentiment->class;
        $threadSummaryBufferFragment = "[{$postSentiment}] {$post->content}. ";

        // Upsert the buffer fragment to the thread summary
        $this->threadSummaryRepository->upsertSummaryBuffer(
            threadSummary: $threadSummary,
            text: $threadSummaryBufferFragment
        );

        return $threadSummary;
    }

    public function updateSummary(ThreadSummary $threadSummary): ThreadSummary
    {
        $summaryBuffer = $threadSummary->summary_buffer;
        $summary = $this->summarizationRepository->summarize($summaryBuffer);
        $threadSummary = $this->threadSummaryRepository->updateSummary(
            threadSummary: $threadSummary,
            text: $summary
        );

        return $threadSummary;
    }
}
