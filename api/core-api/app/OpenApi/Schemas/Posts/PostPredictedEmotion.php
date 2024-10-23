<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="PostPredictedEmotion",
 *     type="object",
 *     title="Post Predicted Emotion",
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="emotion_id", type="integer", format="int64"),
 *     @OA\Property(property="probability", type="number", format="float"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="emotion",
 *         ref="#/components/schemas/Emotion",
 *         description="The emotion class for the predicted emotion"
 *     )
 * )
 */

class PostPredictedEmotion {}
