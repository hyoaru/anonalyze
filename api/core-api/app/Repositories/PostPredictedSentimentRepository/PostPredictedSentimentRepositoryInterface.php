<?php

namespace App\Repositories\PostPredictedSentimentRepository;

use App\Models\Posts\PostPredictedSentiment;

interface PostPredictedSentimentRepositoryInterface
{
    public function new(array $params): PostPredictedSentiment;
}
