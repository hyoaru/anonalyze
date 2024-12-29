<?php

namespace App\Services\SentimentService;

use App\Models\Sentiment;
use Illuminate\Database\Eloquent\Collection;

interface SentimentServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Sentiment;
}
