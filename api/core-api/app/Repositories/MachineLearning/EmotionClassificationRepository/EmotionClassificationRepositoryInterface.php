<?php

namespace App\Repositories\MachineLearning\EmotionClassificationRepository;

interface EmotionClassificationRepositoryInterface
{
    public function classify(string $text): array;
}
