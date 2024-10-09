<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emotion\StoreEmotionRequest;
use App\Http\Requests\Emotion\UpdateEmotionRequest;
use App\Models\Emotion;

class EmotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ['data' => Emotion::all()];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmotionRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Emotion $emotion)
    {
        $data = ['data' => $emotion];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmotionRequest $request, Emotion $emotion) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emotion $emotion) {}
}
