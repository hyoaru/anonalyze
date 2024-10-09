<?php

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\ThreadExtractedConcept\StoreThreadExtractedConceptRequest;
use App\Http\Requests\Threads\ThreadExtractedConcept\UpdateThreadExtractedConceptRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Threads\ThreadExtractedConcept;

class ThreadExtractedConceptController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['data' => ThreadExtractedConcept::all()];
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadExtractedConceptRequest $request)
    {
        $validatedData = $request->validated();
        $threadExtractedConcept = ThreadExtractedConcept::create($validatedData);
        $response = ['data' => $threadExtractedConcept];

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadExtractedConcept $threadExtractedConcept)
    {
        $response = ['data' => $threadExtractedConcept];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadExtractedConceptRequest $request, ThreadExtractedConcept $threadExtractedConcept)
    {
        $this->authorize('update', $threadExtractedConcept);
        $validatedData = $request->validated();
        $threadExtractedConcept->update($validatedData);
        $response = ['data' => $threadExtractedConcept];

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadExtractedConcept $threadExtractedConcept)
    {
        $this->authorize('delete', $threadExtractedConcept);
        $threadExtractedConcept->delete();
        $response = ['data' => $threadExtractedConcept];

        return $response;
    }
}
