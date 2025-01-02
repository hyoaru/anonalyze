<?php

namespace App\Repositories\PostRepository;

use App\Models\Posts\Post;

class PostRepository implements PostRepositoryInterface
{
    public function new(array $params): Post
    {
        $post = new Post($params);

        return $post;
    }

    public function update(Post $post, array $params): Post
    {
        $post->update($params);

        return $post;
    }
}
