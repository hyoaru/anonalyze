<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSentimentRequest;
use App\Http\Requests\UpdateSentimentRequest;
use App\Models\Sentiment;

class SentimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSentimentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sentiment $sentiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSentimentRequest $request, Sentiment $sentiment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentiment $sentiment)
    {
        //
    }
}
