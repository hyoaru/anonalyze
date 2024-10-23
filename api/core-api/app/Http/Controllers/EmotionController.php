<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emotion\StoreEmotionRequest;
use App\Http\Requests\Emotion\UpdateEmotionRequest;
use App\Models\Emotion;

class EmotionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/emotions",
     *     tags={"Emotions"},
     *     summary="Get a list of emotions",
     *     description="Returns a list of all emotions",
     *     @OA\Response(
     *         response=200,
     *         description="A list of emotions",
     *         @OA\JsonContent(ref="#/components/schemas/IndexEmotionResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/emotions/{id}",
     *     tags={"Emotions"},
     *     summary="Retrieve a emotion by its ID",
     *     description="Get a emotion data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the emotion to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the emotion",
     *         @OA\JsonContent(ref="#/components/schemas/ShowEmotionResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Emotion not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
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
