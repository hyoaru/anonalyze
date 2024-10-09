<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use App\Models\Threads\Thread;
use App\Http\Requests\Threads\Thread\StoreThreadRequest;
use App\Http\Requests\Threads\Thread\UpdateThreadRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ThreadController extends Controller implements HasMiddleware
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
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $response = ['data' => $thread];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $validatedData = $request->validated();
        $thread->update($validatedData);
        $response = ['data' => $thread];

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        $response = ['data' => $thread];

        return $response;
    }
}
