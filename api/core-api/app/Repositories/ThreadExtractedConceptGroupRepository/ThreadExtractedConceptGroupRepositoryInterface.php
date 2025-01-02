<?php

namespace App\Repositories\ThreadExtractedConceptGroupRepository;

use App\Models\Threads\ThreadExtractedConceptGroup;

interface ThreadExtractedConceptGroupRepositoryInterface
{
    public function new(): ThreadExtractedConceptGroup;

    public function updateConcepts(int $id, array $extractedConcepts): ThreadExtractedConceptGroup;

    public function deleteConcepts(int $id): void;
}
