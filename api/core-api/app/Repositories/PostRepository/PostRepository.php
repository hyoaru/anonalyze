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

    public function update(int $id, array $params): Post
    {
        $post = Post::findOrFail($id);

        $post->update($params);

        return $post;
    }
}
