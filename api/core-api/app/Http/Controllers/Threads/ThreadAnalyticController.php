<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\ThreadAnalytic\StoreThreadAnalyticRequest;
use App\Http\Requests\Threads\ThreadAnalytic\UpdateThreadAnalyticRequest;
use App\Models\Threads\ThreadAnalytic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ThreadAnalyticController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadAnalyticRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(ThreadAnalytic $threadAnalytic)
    {
        $response = ['data' => $threadAnalytic->load([
            'threadExtractedConceptGroup',
            'threadExtractedConceptGroup.threadExtractedConcepts',
        ])];

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadAnalyticRequest $request, ThreadAnalytic $threadAnalytic) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadAnalytic $threadAnalytic)
    {
        $this->authorize('delete', $threadAnalytic);
        $threadAnalytic->delete();
        $response = ['data' => $threadAnalytic];
        return $response;
    }
}
