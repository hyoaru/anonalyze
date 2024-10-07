<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadSummaries\StoreThreadSummaryRequest;
use App\Http\Requests\ThreadSummaries\UpdateThreadSummaryRequest;
use App\Models\ThreadSummary;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ThreadSummaryController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: [
                'index',
                'show'
            ])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['data' => ThreadSummary::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadSummaryRequest $request)
    {
        $validatedData = $request->validated();
        $user = $request->user();
        $thread = $user->threads()->findOrFail($validatedData['thread_id']);
        $threadSummary = $thread->threadSummary()->create([
            'summary' => $validatedData['summary']
        ]);

        $response = ['data' => $threadSummary];
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadSummary $threadSummary)
    {
        $response = ['data' => $threadSummary];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadSummaryRequest $request, ThreadSummary $threadSummary)
    {
        $this->authorize('update', $threadSummary);
        $validatedData = $request->validated();
        $threadSummary->update($validatedData);
        $response = ['data' => $threadSummary];
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadSummary $threadSummary)
    {
        $this->authorize('delete', $threadSummary);
        $threadSummary->delete();
        $response = ['data' => $threadSummary];

        return $response;
    }
}
