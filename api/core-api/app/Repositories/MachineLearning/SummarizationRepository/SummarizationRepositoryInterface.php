<?php

namespace App\Repositories\MachineLearning\SummarizationRepository;

interface SummarizationRepositoryInterface
{
    public function summarize(string $text): string;
}
