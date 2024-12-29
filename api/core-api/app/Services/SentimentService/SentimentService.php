<?php

namespace App\Services\SentimentService;

use App\Models\Sentiment;
use App\Repositories\SentimentRepository\SentimentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SentimentService implements SentimentServiceInterface
{
    protected SentimentRepositoryInterface $sentimentRepository;

    public function __construct(SentimentRepositoryInterface $sentimentRepository)
    {
        $this->sentimentRepository = $sentimentRepository;
    }

    public function getAll(): Collection
    {
        return $this->sentimentRepository->getAll();
    }

    public function getById(int $id): ?Sentiment
    {
        return $this->sentimentRepository->getById($id);
    }
}
