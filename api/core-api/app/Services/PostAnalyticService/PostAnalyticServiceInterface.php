<?php

namespace App\Services\PostAnalyticService;

use App\Models\Posts\PostAnalytic;
use Illuminate\Database\Eloquent\Collection;

interface PostAnalyticServiceInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?PostAnalytic;
}
