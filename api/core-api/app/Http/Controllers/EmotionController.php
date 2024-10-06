<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmotionRequest;
use App\Http\Requests\UpdateEmotionRequest;
use App\Models\Emotion;

class EmotionController extends Controller
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
    public function store(StoreEmotionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Emotion $emotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmotionRequest $request, Emotion $emotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emotion $emotion)
    {
        //
    }
}
