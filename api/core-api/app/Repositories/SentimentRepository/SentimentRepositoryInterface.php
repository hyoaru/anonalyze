<?php

namespace App\Repositories\SentimentRepository;

use App\Models\Sentiment;
use Illuminate\Database\Eloquent\Collection;

interface SentimentRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Sentiment;

    public function getByClass(string $class): ?Sentiment;
}
