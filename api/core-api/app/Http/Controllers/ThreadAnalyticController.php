<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadAnalytics\StoreThreadAnalyticRequest;
use App\Http\Requests\ThreadAnalytics\UpdateThreadAnalyticRequest;
use App\Models\ThreadAnalytic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ThreadAnalyticController extends Controller implements HasMiddleware
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
        $response = ['data' => ThreadAnalytic::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadAnalyticRequest $request)
    {
        $validatedData = $request->validated();
        $threadAnalytic = ThreadAnalytic::create($validatedData);
        $response = ['data' => $threadAnalytic];
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadAnalytic $threadAnalytic)
    {
        $response = ['data' => $threadAnalytic];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadAnalyticRequest $request, ThreadAnalytic $threadAnalytic)
    {
        $this->authorize('update', $threadAnalytic);
        $validatedData = $request->validated();
        $threadAnalytic->update($validatedData);
        $response = ['data' => $threadAnalytic];
        return $response;
    }

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
