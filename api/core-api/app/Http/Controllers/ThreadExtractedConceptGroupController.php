<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadExtractedConceptGroups\StoreThreadExtractedConceptGroupRequest;
use App\Http\Requests\ThreadExtractedConceptGroups\UpdateThreadExtractedConceptGroupRequest;
use App\Models\ThreadExtractedConceptGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ThreadExtractedConceptGroupController extends Controller implements HasMiddleware
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
        $response = ['data' => ThreadExtractedConceptGroup::with('threadExtractedConcepts')->get()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadExtractedConceptGroupRequest $request)
    {
        $validatedData = $request->validated();
        $threadExtractedConceptGroup = ThreadExtractedConceptGroup::created($validatedData);
        $response = ['data' => $threadExtractedConceptGroup];
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadExtractedConceptGroup $threadExtractedConceptGroup)
    {
        $response = ['data' => $threadExtractedConceptGroup];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadExtractedConceptGroupRequest $request, ThreadExtractedConceptGroup $threadExtractedConceptGroup) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadExtractedConceptGroup $threadExtractedConceptGroup)
    {
        $this->authorize('delete', $threadExtractedConceptGroup);
        $threadExtractedConceptGroup->delete();
        $response = ['data' => $threadExtractedConceptGroup];
        return $response;
    }
}
