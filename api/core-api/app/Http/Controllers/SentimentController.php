<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sentiment\StoreSentimentRequest;
use App\Http\Requests\Sentiment\UpdateSentimentRequest;
use App\Models\Sentiment;

class SentimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ['data' => Sentiment::all()];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSentimentRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Sentiment $sentiment)
    {
        $data = ['data' => $sentiment];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSentimentRequest $request, Sentiment $sentiment) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentiment $sentiment) {}
}
