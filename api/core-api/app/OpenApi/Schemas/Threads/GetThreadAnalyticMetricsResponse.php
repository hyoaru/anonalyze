<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GetThreadAnalyticMetricsResponse",
 *     type="object",
 *     required={"total_response", "key_concept", "leading_sentiment", "leading_emotion", "sentiment_ratio"},
 *     @OA\Property(property="total_response", type="integer", description="Total number of responses in the thread", example=15),
 *     @OA\Property(property="key_concept", type="string", description="The key concept of the thread", example="Sustainability"),
 *     @OA\Property(property="leading_sentiment", type="string", description="Leading sentiment of the responses", example="positive"),
 *     @OA\Property(property="leading_emotion", type="string", description="Leading emotion in the responses", example="joy"),
 *     @OA\Property(
 *         property="sentiment_ratio",
 *         type="object",
 *         description="Ratio of sentiments in the thread responses",
 *         example={"positive": 0.6, "neutral": 0.3, "negative": 0.1},
 *         @OA\Property(property="positive", type="number", format="float"),
 *         @OA\Property(property="neutral", type="number", format="float"),
 *         @OA\Property(property="negative", type="number", format="float")
 *     )
 * )
 */
class GetThreadAnalyticMetricsResponse {}
