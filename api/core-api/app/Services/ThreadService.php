<?php

namespace App\Services;

use App\Models\Threads\Thread;
use App\Models\Threads\ThreadExtractedConceptGroup;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class ThreadService
{
    public static function createThread(array $validatedData)
    {
        $user = Auth::user();

        throw_if(!$user, new Exception("Must be authenticated to create a thread"));

        $thread = Thread::create([
            'user_id' => $user->id,
            'question' => $validatedData['question']
        ]);

        $threadExtractedConceptGroup = ThreadExtractedConceptGroup::create();

        $threadAnalytic = $thread->threadAnalytic()->create([
            'thread_extracted_concept_group_id' => $threadExtractedConceptGroup->id
        ]);

        return $thread;
    }

    public static function updateThread($thread, array $validatedData)
    {
        if (!$thread instanceof Thread) {
            $thread = Thread::findOrFail($thread);
        }

        $thread->update($validatedData);
        return $thread;
    }
}
