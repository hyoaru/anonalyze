<?php

namespace App\Repositories\PostPredictedEmotionRepository;

use App\Models\Posts\PostPredictedEmotion;

interface PostPredictedEmotionRepositoryInterface
{
    public function new(array $params): PostPredictedEmotion;
}
