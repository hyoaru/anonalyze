<?php

namespace App\Repositories\EmotionRepository;

use App\Models\Emotion;
use Illuminate\Database\Eloquent\Collection;

interface EmotionRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Emotion;
}
