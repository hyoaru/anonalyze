<?php

namespace App\Repositories\ThreadRepository;

use App\Models\Threads\Thread;

class ThreadRepository implements ThreadRepositoryInterface
{
    public function get(int $id): ?Thread
    {
        return Thread::find($id);
    }

    public function new(array $params): Thread
    {
        $thread = new Thread;
        $thread->question = $params['question'];

        return $thread;
    }

    public function update(int $id, array $params): Thread
    {
        $thread = Thread::findOrFail($id);
        $thread->update($params);

        return $thread;
    }
}
