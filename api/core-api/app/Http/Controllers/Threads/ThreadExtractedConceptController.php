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
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadExtractedConceptRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(ThreadExtractedConcept $threadExtractedConcept) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadExtractedConceptRequest $request, ThreadExtractedConcept $threadExtractedConcept) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadExtractedConcept $threadExtractedConcept) {}
}
