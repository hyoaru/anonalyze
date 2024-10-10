<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use App\Models\Threads\Thread;
use App\Http\Requests\Threads\Thread\StoreThreadRequest;
use App\Http\Requests\Threads\Thread\UpdateThreadRequest;
use App\Services\ThreadService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThreadController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: [
                'show'
            ])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $threads = $user->threads->load([
            'threadSummary',
            'threadAnalytic',
            'threadAnalytic.threadExtractedConceptGroup',
            'threadAnalytic.threadExtractedConceptGroup.threadExtractedConcepts',
        ]);

        $data = ['data' => $threads];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $thread = ThreadService::createThread($validatedData);
            DB::commit();

            $data = ['data' => $thread->load([
                'threadSummary',
                'threadAnalytic',
                'threadAnalytic.threadExtractedConceptGroup',
                'threadAnalytic.threadExtractedConceptGroup.threadExtractedConcepts',
            ])];

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, "Failed to create thread. " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $data = ['data' => $thread];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $validatedData = $request->validated();
        $thread = ThreadService::updateThread($thread, $validatedData);
        $data = ['data' => $thread];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        $data = ['data' => $thread];

        return response()->json($data, 200);
    }
}
