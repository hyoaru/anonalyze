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
        $threadSummary = $thread->threadSummary;

        // Get the thread summary buffer and replace all occurences of the tag with empty character
        $threadSummaryBuffer = $threadSummary->summary_buffer;
        $formattedThreadSummaryBuffer = str_replace(
            ['[positive]', '[negative]', '[neutral]'],
            '',
            $threadSummaryBuffer
        );

        // Extract concepts from the thread summary buffer
        $extractedConcepts = $this->conceptExtractionRepository->extract($formattedThreadSummaryBuffer);

        // Detele all existing concepts and add the new ones
        $this->threadExtractedConceptGroupRepository->deleteConcepts($threadExtractedConceptGroup);
        $threadExtractedConceptGroup = $this->threadExtractedConceptGroupRepository->updateConcepts(
            threadExtractedConceptGroup: $threadExtractedConceptGroup,
            extractedConcepts: $extractedConcepts,
        );

        return $threadExtractedConceptGroup;
    }
}
