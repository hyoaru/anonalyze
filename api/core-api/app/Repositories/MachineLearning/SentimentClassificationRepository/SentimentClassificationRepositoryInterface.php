<?php

namespace App\Repositories\MachineLearning\SentimentClassificationRepository;

interface SentimentClassificationRepositoryInterface
{
    public function classify(string $text): array;
}
