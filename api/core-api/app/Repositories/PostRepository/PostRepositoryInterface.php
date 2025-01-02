<?php

namespace App\Repositories\PostRepository;

use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getByThread(int $threadId): Collection;

    public function new(array $params): Post;

    public function update(int $id, array $params): Post;
}
