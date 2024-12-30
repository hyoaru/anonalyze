<?php

namespace App\Repositories\PostAnalyticRepository;

use App\Models\Posts\PostAnalytic;
use Illuminate\Database\Eloquent\Collection;

class PostAnalyticRepository implements PostAnalyticRepositoryInterface
{
    public function getAll(): Collection
    {
        return PostAnalytic::all();
    }

    public function getById(int $id): ?PostAnalytic
    {
        return PostAnalytic::find($id);
    }
}
