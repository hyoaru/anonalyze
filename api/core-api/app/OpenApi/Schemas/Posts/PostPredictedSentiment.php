<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="PostPredictedSentiment",
 *     type="object",
 *     title="Post Predicted Sentiment",
 *     required={"id", "sentiment_id", "probability", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="sentiment_id", type="integer", format="int64"),
 *     @OA\Property(property="probability", type="number", format="float"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="sentiment",
 *         ref="#/components/schemas/Sentiment",
 *         description="The sentiment class for the predicted sentiment"
 *     )
 * )
 */

class PostPredictedSentiment {}
