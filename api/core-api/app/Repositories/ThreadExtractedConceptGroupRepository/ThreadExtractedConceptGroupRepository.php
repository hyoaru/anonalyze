<?php

namespace App\Repositories\ThreadExtractedConceptGroupRepository;

use App\Models\Threads\ThreadExtractedConceptGroup;
use App\Repositories\PostRepository\PostRepositoryInterface;

class ThreadExtractedConceptGroupRepository implements ThreadExtractedConceptGroupRepositoryInterface
{
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function new(): ThreadExtractedConceptGroup
    {
        return new ThreadExtractedConceptGroup;
    }

    public function updateConcepts(ThreadExtractedConceptGroup $threadExtractedConceptGroup, array $extractedConcepts): ThreadExtractedConceptGroup
    {
        foreach ($extractedConcepts as $concept => $significanceScore) {
            $threadExtractedConceptGroup->threadExtractedConcepts()->create([
                'concept' => $concept,
                'significance_score' => $significanceScore,
            ]);
        }

        return $threadExtractedConceptGroup;
    }

    public function deleteConcepts(ThreadExtractedConceptGroup $threadExtractedConceptGroup): void
    {
        $threadExtractedConceptGroup->threadExtractedConcepts()->delete();
    }
}
