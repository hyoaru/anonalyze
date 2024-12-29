<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sentiment\StoreSentimentRequest;
use App\Http\Requests\Sentiment\UpdateSentimentRequest;
use App\Models\Sentiment;
use App\Services\SentimentService\SentimentServiceInterface;

class SentimentController extends Controller
{
    protected SentimentServiceInterface $sentimentService;

    public function __construct(SentimentServiceInterface $sentimentService)
    {
        $this->sentimentService = $sentimentService;
    }

    /**
     * @OA\Get(
     *     path="/api/sentiments",
     *     tags={"Sentiments"},
     *     summary="Get a list of sentiments",
     *     description="Returns a list of all sentiments",
     *
     *     @OA\Response(
     *         response=200,
     *         description="A list of sentiments",
     *
     *         @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(ref="#/components/schemas/Sentiment"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *     ),
     * )
     */
    public function index()
    {
        $data = $this->sentimentService->getAll();

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSentimentRequest $request) {}

    /**
     * @OA\Get(
     *     path="/api/sentiments/{id}",
     *     tags={"Sentiments"},
     *     summary="Retrieve a sentiment by its ID",
     *     description="Get a sentiment data",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the sentiment to retrieve",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of the sentiment",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Sentiment"),
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Sentiment not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show(Sentiment $sentiment)
    {
        $data = $sentiment;

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
