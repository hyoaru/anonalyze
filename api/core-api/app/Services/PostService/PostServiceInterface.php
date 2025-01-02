<?php

namespace App\Services\PostService;

use App\Models\Posts\Post;

interface PostServiceInterface
{
    public function new(array $params): Post;
}
