<?php

namespace App\Repositories\EmotionRepository;

use App\Models\Emotion;
use Illuminate\Database\Eloquent\Collection;

class EmotionRepository implements EmotionRepositoryInterface
{
    public function getAll(): Collection
    {
        return Emotion::all();
    }

    public function getById(int $id): ?Emotion
    {
        return Emotion::find($id);
    }

    public function getByClass(string $class): ?Emotion
    {
        return Emotion::where('class', $class)->first();
    }
}
