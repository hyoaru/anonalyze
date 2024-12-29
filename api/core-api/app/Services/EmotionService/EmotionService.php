<?php

namespace App\Services\EmotionService;

use App\Models\Emotion;
use App\Repositories\EmotionRepository\EmotionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EmotionService implements EmotionServiceInterface
{
    protected EmotionRepositoryInterface $emotionRepository;

    public function __construct(EmotionRepositoryInterface $emotionRepository)
    {
        $this->emotionRepository = $emotionRepository;
    }

    public function getAll(): Collection
    {
        return $this->emotionRepository->getAll();
    }

    public function getById(int $id): ?Emotion
    {
        return $this->emotionRepository->getById($id);
    }
}
