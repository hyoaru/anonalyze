<?php

namespace App\Services\MachineLearning\ConceptExtractionService;

use App\Repositories\MachineLearning\ConceptExtractionRepository\ConceptExtractionRepositoryInterface;

class ConceptExtractionService implements ConceptExtractionServiceInterface
{
    protected ConceptExtractionRepositoryInterface $conceptExtractionRepository;

    public function __construct(
        ConceptExtractionRepositoryInterface $conceptExtractionRepository
    ) {
        $this->conceptExtractionRepository = $conceptExtractionRepository;
    }

    public function extract(string $text): array
    {
        $extractedConcepts = $this->conceptExtractionRepository->extract($text);

        return $extractedConcepts;
    }
}
