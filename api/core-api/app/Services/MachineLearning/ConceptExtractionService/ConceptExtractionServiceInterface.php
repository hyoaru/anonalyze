<?php

namespace App\Services\MachineLearning\ConceptExtractionService;

interface ConceptExtractionServiceInterface
{
    public function extract(string $text): array;
}
