<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\ThreadExtractedConceptGroup\StoreThreadExtractedConceptGroupRequest;
use App\Http\Requests\Threads\ThreadExtractedConceptGroup\UpdateThreadExtractedConceptGroupRequest;
use App\Models\ThreadExtractedConceptGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ThreadExtractedConceptGroupController extends Controller
{
    use AuthorizesRequests;

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
