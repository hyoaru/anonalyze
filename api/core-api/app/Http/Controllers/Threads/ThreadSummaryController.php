<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\ThreadSummary\StoreThreadSummaryRequest;
use App\Http\Requests\Threads\ThreadSummary\UpdateThreadSummaryRequest;
use App\Models\Threads\ThreadSummary;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ThreadSummaryController extends Controller
{
    use AuthorizesRequests;

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
        $threadSummary = ThreadSummary::create($validatedData);
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
