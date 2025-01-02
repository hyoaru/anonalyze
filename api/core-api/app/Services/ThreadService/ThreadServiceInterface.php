<?php

namespace App\Services\ThreadService;

use App\Models\Threads\Thread;

interface ThreadServiceInterface
{
    public function new(array $params): Thread;

    public function update(int $id, array $params): Thread;
}
