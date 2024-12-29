<?php

namespace App\Services\EmotionService;

use App\Models\Emotion;
use Illuminate\Database\Eloquent\Collection;

interface EmotionServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Emotion;
}
