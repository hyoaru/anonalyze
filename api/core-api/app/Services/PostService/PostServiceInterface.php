<?php

namespace App\Services\PostService;

use App\Models\Posts\Post;
use App\Models\Threads\Thread;

interface PostServiceInterface
{
    public function new(Thread $thread, array $params): Post;
}
