<?php

namespace App\Repositories\PostAnalyticRepository;

use App\Models\Posts\PostAnalytic;
use Illuminate\Database\Eloquent\Collection;

interface PostAnalyticRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?PostAnalytic;

    public function new(): PostAnalytic;
}
