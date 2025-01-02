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

    public function updateConcepts(int $id): ThreadExtractedConceptGroup
    {
        $postContents = $this->postRepository->getByThread($id)->toArray();
        $extractedConcepts = $this->conceptExtractionRepository->extract($postContents);
        $this->threadExtractedConceptGroupRepository->deleteConcepts($id);
        $threadExtractedConceptGroup = $this->threadExtractedConceptGroupRepository->updateConcepts($id, $extractedConcepts);

        return $threadExtractedConceptGroup;
    }
}
