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

    public function updateConcepts(int $id, array $extractedConcepts): ThreadExtractedConceptGroup
    {
        $threadExtractedConceptGroup = ThreadExtractedConceptGroup::findOrFail($id);

        foreach ($extractedConcepts as $concept => $significanceScore) {
            $threadExtractedConceptGroup->threadExtractedConcepts()->create([
                'concept' => $concept,
                'significance_score' => $significanceScore,
            ]);
        }

        return $threadExtractedConceptGroup;
    }

    public function deleteConcepts(int $id): void
    {
        $threadExtractedConceptGroup = ThreadExtractedConceptGroup::findOrFail($id);
        $threadExtractedConceptGroup->threadExtractedConcepts()->delete();
    }
}
