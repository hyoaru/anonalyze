<?php

namespace App\Services\ThreadService;

use App\Models\Threads\Thread;
use App\Models\User;
use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepositoryInterface;
use App\Repositories\ThreadExtractedConceptGroupRepository\ThreadExtractedConceptGroupRepositoryInterface;
use App\Repositories\ThreadRepository\ThreadRepositoryInterface;
use App\Repositories\ThreadSummaryRepository\ThreadSummaryRepositoryInterface;

class ThreadService implements ThreadServiceInterface
{
    protected ThreadRepositoryInterface $threadRepository;

    protected ThreadAnalyticRepositoryInterface $threadAnalyticRepository;

    protected ThreadExtractedConceptGroupRepositoryInterface $threadExtractedConceptGroupRepository;

    protected ThreadSummaryRepositoryInterface $threadSummaryRepository;

    public function __construct(
        ThreadRepositoryInterface $threadRepository,
        ThreadAnalyticRepositoryInterface $threadAnalyticRepository,
        ThreadExtractedConceptGroupRepositoryInterface $threadExtractedConceptGroupRepository,
        ThreadSummaryRepositoryInterface $threadSummaryRepository
    ) {
        $this->threadRepository = $threadRepository;
        $this->threadAnalyticRepository = $threadAnalyticRepository;
        $this->threadExtractedConceptGroupRepository = $threadExtractedConceptGroupRepository;
        $this->threadSummaryRepository = $threadSummaryRepository;
    }

    public function new(User $user, array $threadParams): Thread
    {
        // Create a new thread and associate it with the user
        $thread = $this->threadRepository->new($threadParams);
        $thread->user()->associate($user);
        $thread->save();

        // Create a new thread summary and associate it with the thread
        $threadSummary = $this->threadSummaryRepository->new();
        $threadSummary->thread()->associate($thread);
        $threadSummary->save();

        // Create a new thread extracted concept group
        $threadExtractedConceptGroup = $this->threadExtractedConceptGroupRepository->new();
        $threadExtractedConceptGroup->save();

        // Create a new thread analytic and associate it with the thread and thread extracted concept group
        $threadAnalytic = $this->threadAnalyticRepository->new();
        $threadAnalytic->thread()->associate($thread);
        $threadAnalytic->thread_extracted_concept_group_id = $threadExtractedConceptGroup->id;
        $threadAnalytic->save();

        return $thread;
    }

    public function update(Thread $thread, array $threadParams): Thread
    {
        $thread = $this->threadRepository->update(
            thread: $thread,
            params: $threadParams,
        );

        return $thread;
    }
}
