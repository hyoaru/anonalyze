<?php

namespace App\Http\Controllers;

use App\Models\Emotion;
use App\Services\EmotionService\EmotionServiceInterface;

class EmotionController extends Controller
{
    protected EmotionServiceInterface $emotionService;

    public function __construct(EmotionServiceInterface $emotionService)
    {
        $this->emotionService = $emotionService;
    }

    /**
     * @OA\Get(
     *     path="/api/emotions",
     *     tags={"Emotions"},
     *     summary="Get a list of emotions",
     *     description="Returns a list of all emotions",
     *
     *     @OA\Response(
     *         response=200,
     *         description="A list of emotions",
     *
     *         @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(ref="#/components/schemas/Emotion"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index()
    {
        $data = $this->emotionService->getAll();

        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/emotions/{id}",
     *     tags={"Emotions"},
     *     summary="Retrieve a emotion by its ID",
     *     description="Get a emotion data",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the emotion to retrieve",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the emotion",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Emotion")
     *     ),
     *
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
        $data = $emotion;

        return response()->json($data, 200);
    }
}
