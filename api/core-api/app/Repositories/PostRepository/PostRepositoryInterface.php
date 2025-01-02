<?php

namespace App\Repositories\PostRepository;

use App\Models\Posts\Post;

interface PostRepositoryInterface
{
    public function new(array $params): Post;

    public function update(Post $post, array $params): Post;
}
