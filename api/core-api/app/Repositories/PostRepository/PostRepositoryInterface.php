<?php

namespace App\Repositories\PostRepository;

use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getByThread(int $threadId): Collection;
}
