<?php

namespace App\Services\ThreadService;

use App\Models\Threads\Thread;
use App\Models\User;
use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepositoryInterface;
use App\Repositories\ThreadExtractedConceptGroupRepository\ThreadExtractedConceptGroupRepositoryInterface;
use App\Repositories\ThreadRepository\ThreadRepositoryInterface;

class ThreadService implements ThreadServiceInterface
{
    protected ThreadRepositoryInterface $threadRepository;

    protected ThreadAnalyticRepositoryInterface $threadAnalyticRepository;

    protected ThreadExtractedConceptGroupRepositoryInterface $threadExtractedConceptGroupRepository;

    public function __construct(
        ThreadRepositoryInterface $threadRepository,
        ThreadAnalyticRepositoryInterface $threadAnalyticRepository,
        ThreadExtractedConceptGroupRepositoryInterface $threadExtractedConceptGroupRepository
    ) {
        $this->threadRepository = $threadRepository;
        $this->threadAnalyticRepository = $threadAnalyticRepository;
        $this->threadExtractedConceptGroupRepository = $threadExtractedConceptGroupRepository;
    }

    public function new(User $user, array $threadParams): Thread
    {
        $thread = $this->threadRepository->new($threadParams);
        $thread->user()->associate($user);
        $thread->save();

        $threadExtractedConceptGroup = $this->threadExtractedConceptGroupRepository->new();
        $threadExtractedConceptGroup->save();

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
