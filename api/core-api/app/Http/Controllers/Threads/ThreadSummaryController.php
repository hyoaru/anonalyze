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
     * @OA\Get(
     *     path="/api/thread-summaries/{id}",
     *     tags={"Thread summaries"},
     *     summary="Retrieve a thread summary by its ID",
     *     description="Get a thread summary along with its analytics, sentiment, and emotion data",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread summary to retrieve",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the thread summary and its analytics",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ThreadSummary")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Thread summary not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show(ThreadSummary $threadSummary)
    {
        $data = $threadSummary;

        return response()->json($data, 200);
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
