<?php

namespace App\Services\ThreadService;

use App\Models\Threads\Thread;
use App\Models\User;

interface ThreadServiceInterface
{
    public function new(User $user, array $params): Thread;

    public function update(int $id, array $params): Thread;
}
