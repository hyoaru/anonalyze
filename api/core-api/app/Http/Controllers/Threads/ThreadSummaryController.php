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
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadSummaryRequest $request) {}

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
    public function update(UpdateThreadSummaryRequest $request, ThreadSummary $threadSummary) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadSummary $threadSummary) {}
}
