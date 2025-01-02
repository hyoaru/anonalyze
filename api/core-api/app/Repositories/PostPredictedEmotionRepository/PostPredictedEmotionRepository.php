<?php

namespace App\Repositories\PostPredictedEmotionRepository;

use App\Models\Posts\PostPredictedEmotion;

class PostPredictedEmotionRepository implements PostPredictedEmotionRepositoryInterface
{
    public function new(array $params): PostPredictedEmotion
    {
        $postPredictedEmotion = new PostPredictedEmotion;
        $postPredictedEmotion->probability = $params['probability'];

        return $postPredictedEmotion;
    }
}
