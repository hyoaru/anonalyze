<?php

namespace App\Services\ThreadExtractedConceptGroupService;

use App\Models\Threads\ThreadExtractedConceptGroup;

interface ThreadExtractedConceptGroupServiceInterface
{
    public function updateConcepts(int $id): ThreadExtractedConceptGroup;
}
