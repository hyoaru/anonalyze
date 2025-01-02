<?php

namespace App\Repositories\ThreadRepository;

use App\Models\Threads\Thread;

interface ThreadRepositoryInterface
{
    public function get(int $id): ?Thread;

    public function new(array $params): Thread;

    public function update(int $id, array $params): Thread;
}
