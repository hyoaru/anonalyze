<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadExtractedConcepts\StoreThreadExtractedConceptRequest;
use App\Http\Requests\ThreadExtractedConcepts\UpdateThreadExtractedConceptRequest;
use App\Models\ThreadExtractedConcept;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ThreadExtractedConceptController extends Controller implements HasMiddleware
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
