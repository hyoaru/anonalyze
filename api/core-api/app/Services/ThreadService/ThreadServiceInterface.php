<?php

namespace App\Services\ThreadService;

use App\Models\Threads\Thread;
use App\Models\User;

interface ThreadServiceInterface
{
    public function new(User $user, array $threadParams): Thread;

    public function update(Thread $thread, array $threadParams): Thread;
}
