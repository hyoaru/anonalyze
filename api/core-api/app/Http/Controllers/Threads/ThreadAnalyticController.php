<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\ThreadAnalytic\StoreThreadAnalyticRequest;
use App\Http\Requests\Threads\ThreadAnalytic\UpdateThreadAnalyticRequest;
use App\Models\Threads\Thread;
use App\Models\Threads\ThreadAnalytic;
use App\Services\ThreadAnalyticService\ThreadAnalyticServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ThreadAnalyticController extends Controller
{
    use AuthorizesRequests;

    protected ThreadAnalyticServiceInterface $threadAnalyticService;

    public function __construct(ThreadAnalyticServiceInterface $threadAnalyticService)
    {
        $this->threadAnalyticService = $threadAnalyticService;
    }

    public function index() {}

    public function store(StoreThreadAnalyticRequest $request) {}

    /**
     * @OA\Get(
     *     path="/api/thread-analytics/{id}",
     *     tags={"Thread analytics"},
     *     summary="Retrieve a thread analytic by its ID",
     *     description="Get a thread analytic along with its analytics, sentiment, and emotion data",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread analytic to retrieve",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the thread analytic and its analytics",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ThreadAnalytic")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Thread analytic not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show(ThreadAnalytic $threadAnalytic)
    {
        $response = $threadAnalytic->load([
            'threadExtractedConceptGroup',
            'threadExtractedConceptGroup.threadExtractedConcepts',
        ]);

        return $response;
    }

    public function update(UpdateThreadAnalyticRequest $request, ThreadAnalytic $threadAnalytic) {}

    /**
     * @OA\Delete(
     *     path="/api/thread-analytics/{id}",
     *     tags={"Thread analytics"},
     *     summary="Delete a thread analytic by its ID",
     *     description="Deletes a thread analytic and returns its analytics before deletion",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread analytic to delete",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Thread analytic deleted successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ThreadAnalytic")
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Thread analytic not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function destroy(ThreadAnalytic $threadAnalytic)
    {
        $this->authorize('delete', $threadAnalytic);
        $threadAnalytic->delete();
        $response = $threadAnalytic;

        return $response;
    }

    /**
     * @OA\Get(
     *     path="/api/threads/{id}/thread-analytics/metrics",
     *     tags={"Thread analytics"},
     *     summary="Retrieve a thread analytic metrics by thread ID",
     *     description="Retrieves a thread analytic metrics",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread to retrieve analytic metrics on",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of a thread analytic metrics",
     *
     *         @OA\JsonContent(ref="#/components/schemas/GetThreadAnalyticMetricsResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Thread not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     * )
     */
    public function getThreadAnalyticMetrics(Thread $thread)
    {
        return response()->json($this->threadAnalyticService->getThreadAnalyticMetrics($thread->id), 200);
    }
}
