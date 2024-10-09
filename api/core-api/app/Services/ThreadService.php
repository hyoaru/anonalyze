<?php

namespace App\Services;

use App\Models\Threads\Thread;
use App\Models\Threads\ThreadExtractedConceptGroup;
use App\Models\User;

class ThreadService
{
    public static function createThread(array $validatedData)
    {
        $user = User::where($validatedData['user_id'])->firstOrFail();
        $thread = $user->threads()->create($validatedData);

        $threadExtractedConceptGroup = ThreadExtractedConceptGroup::create();
        $threadAnalytic = $thread->threadAnalytic()->create([
            'thread_extracted_concept_group_id' => $threadExtractedConceptGroup->id
        ]);

        return $thread;
    }

    public static function updateThread($thread, array $validatedData) {
        if (!$thread instanceof Thread) {
            $thread = Thread::findOrFail($thread);
        }

        $thread->update($validatedData);
        return $thread;
    }
}
