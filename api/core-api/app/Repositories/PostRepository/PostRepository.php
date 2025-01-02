<?php

namespace App\Repositories\PostRepository;

use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function getByThread(int $id): Collection
    {
        $posts = Post::where('thread_id', $id)->get();

        return $posts;
    }
}
