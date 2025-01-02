<?php

namespace App\Repositories\ThreadExtractedConceptGroupRepository;

use App\Models\Threads\ThreadExtractedConceptGroup;

interface ThreadExtractedConceptGroupRepositoryInterface
{
    public function new(): ThreadExtractedConceptGroup;

    public function updateConcepts(ThreadExtractedConceptGroup $threadExtractedConceptGroup, array $extractedConcepts): ThreadExtractedConceptGroup;

    public function deleteConcepts(ThreadExtractedConceptGroup $threadExtractedConceptGroup): void;
}
