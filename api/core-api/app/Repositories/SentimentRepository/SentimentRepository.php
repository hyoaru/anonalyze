<?php

namespace App\Repositories\SentimentRepository;

use App\Models\Sentiment;
use Illuminate\Database\Eloquent\Collection;

class SentimentRepository implements SentimentRepositoryInterface
{
    public function getAll(): Collection
    {
        return Sentiment::all();
    }

    public function getById(int $id): ?Sentiment
    {
        return Sentiment::find($id);
    }
}
