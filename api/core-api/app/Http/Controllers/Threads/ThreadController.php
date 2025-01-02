<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\Thread\StoreThreadRequest;
use App\Http\Requests\Threads\Thread\UpdateThreadRequest;
use App\Models\Threads\Thread;
use App\Services\ThreadService\ThreadServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class ThreadController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    protected ThreadServiceInterface $threadService;

    public function __construct(ThreadServiceInterface $threadService)
    {
        $this->threadService = $threadService;
    }

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: [
                'show',
            ]),
        ];
    }

    /**
     * @OA\Get(
     *     path="/api/threads",
     *     tags={"Threads"},
     *     summary="Get a list of threads",
     *     description="Returns a list of all threads",
     *
     *     @OA\Response(
     *         response=200,
     *         description="A list of threads",
     *
     *         @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(ref="#/components/schemas/Thread"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $threads = $user->threads()
            ->with([
                'threadSummary',
                'threadAnalytic',
                'threadAnalytic.threadExtractedConceptGroup',
                'threadAnalytic.threadExtractedConceptGroup.threadExtractedConcepts',
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $threads;

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/threads",
     *     tags={"Threads"},
     *     summary="Create a new thread",
     *     description="Stores a newly created thread",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreThreadRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Thread created successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Thread")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Failed to create thread"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *      security={{"Bearer": {}}}
     *
     * )
     */
    public function store(StoreThreadRequest $request)
    {
        $user = $request->user();
        $validatedData = $request->validated();
        $threadParams = ['question' => $validatedData['question']];

        DB::beginTransaction();
        try {
            $thread = $this->threadService->new(
                user: $user,
                threadParams: $threadParams,
            );

            DB::commit();

            $data = $thread->load([
                'threadSummary',
                'threadAnalytic',
                'threadAnalytic.threadExtractedConceptGroup',
                'threadAnalytic.threadExtractedConceptGroup.threadExtractedConcepts',
            ]);

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, 'Failed to create thread. '.$th->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/threads/{id}",
     *     tags={"Threads"},
     *     summary="Retrieve a thread by its ID",
     *     description="Get a thread along with its analytics",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread to retrieve",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the thread and its analytics",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Thread")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Thread not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show(Thread $thread)
    {
        $data = $thread->load([
            'threadSummary',
            'threadAnalytic',
        ]);

        return response()->json($data, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/threads/{id}",
     *     tags={"Threads"},
     *     summary="Update a thread by its ID",
     *     description="Updates the specified thread with new data",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread to update",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateThreadRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Thread updated successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Thread")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation error or update failed"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Thread not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $validatedData = $request->validated();
        $threadParams = ['question' => $validatedData['question']];

        DB::beginTransaction();

        try {
            $thread = $this->threadService->update(
                thread: $thread,
                threadParams: $threadParams,
            );

            DB::commit();

            $data = $thread->load([
                'threadSummary',
                'threadAnalytic',
            ]);

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, 'Failed to update thread. '.$th->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/threads/{id}",
     *     tags={"Threads"},
     *     summary="Delete a thread by its ID",
     *     description="Deletes a thread and returns its data before deletion",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the thread to delete",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Thread deleted successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Thread")
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Thread not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        $data = $thread;

        return response()->json($data, 200);
    }
}
