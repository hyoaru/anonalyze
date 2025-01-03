<?php

namespace App\Repositories\MachineLearning\ConceptExtractionRepository;

interface ConceptExtractionRepositoryInterface
{
    public function extract(string $text): array;
}
