<?php

namespace App\Repositories\PostPredictedSentimentRepository;

use App\Models\Posts\PostPredictedSentiment;

class PostPredictedSentimentRepository implements PostPredictedSentimentRepositoryInterface
{
    public function new(array $params): PostPredictedSentiment
    {
        $postPredictedSentiment = new PostPredictedSentiment;
        $postPredictedSentiment->probability = $params['probability'];

        return $postPredictedSentiment;
    }
}
