<?php

namespace App\Services\PostAnalyticService;

use App\Models\Posts\PostAnalytic;
use App\Repositories\PostAnalyticRepository\PostAnalyticRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostAnalyticService implements PostAnalyticServiceInterface
{
    protected PostAnalyticRepositoryInterface $postanalyticRepository;

    public function __construct(PostAnalyticRepositoryInterface $postanalyticRepository)
    {
        $this->postanalyticRepository = $postanalyticRepository;
    }

    public function getAll(): Collection
    {
        return $this->postanalyticRepository->getAll();
    }

    public function getById(int $id): ?PostAnalytic
    {
        return $this->postanalyticRepository->getById($id);
    }
}
