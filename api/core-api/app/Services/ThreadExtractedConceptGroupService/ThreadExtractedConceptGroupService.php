<?php

namespace App\Services\ThreadExtractedConceptGroupService;

use App\Models\Threads\ThreadExtractedConceptGroup;
use App\Repositories\MachineLearning\ConceptExtractionRepository\ConceptExtractionRepositoryInterface;
use App\Repositories\PostRepository\PostRepositoryInterface;
use App\Repositories\ThreadExtractedConceptGroupRepository\ThreadExtractedConceptGroupRepositoryInterface;

class ThreadExtractedConceptGroupService implements ThreadExtractedConceptGroupServiceInterface
{
    protected PostRepositoryInterface $postRepository;

    protected ConceptExtractionRepositoryInterface $conceptExtractionRepository;

    protected ThreadExtractedConceptGroupRepositoryInterface $threadExtractedConceptGroupRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        ConceptExtractionRepositoryInterface $conceptExtractionRepository,
        ThreadExtractedConceptGroupRepositoryInterface $threadExtractedConceptGroupRepository
    ) {
        $this->postRepository = $postRepository;
        $this->conceptExtractionRepository = $conceptExtractionRepository;
        $this->threadExtractedConceptGroupRepository = $threadExtractedConceptGroupRepository;
    }

    public function updateConcepts(ThreadExtractedConceptGroup $threadExtractedConceptGroup): ThreadExtractedConceptGroup
    {
        $thread = $threadExtractedConceptGroup->threadAnalytic->thread;

        // Get thread posts and make an array out of the post content
        $postContents = $thread->posts->pluck('content')->toArray();

        // Extract concepts from the post contents
        $extractedConcepts = $this->conceptExtractionRepository->extract($postContents);

        // Detele all existing concepts and add the new ones
        $this->threadExtractedConceptGroupRepository->deleteConcepts($threadExtractedConceptGroup);
        $threadExtractedConceptGroup = $this->threadExtractedConceptGroupRepository->updateConcepts($id, $extractedConcepts);

        return $threadExtractedConceptGroup;
    }
}
