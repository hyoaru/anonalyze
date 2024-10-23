<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="PostAnalytic",
 *     type="object",
 *     title="Post Analytic",
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="post_id", type="integer", format="int64"),
 *     @OA\Property(property="post_predicted_sentiment_id", type="integer", format="int64"),
 *     @OA\Property(property="post_predicted_emotion_id", type="integer", format="int64"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="post",
 *         ref="#/components/schemas/Post",
 *         description="The post this analytic belongs to"
 *     ),
 *     @OA\Property(
 *         property="post_predicted_sentiment",
 *         ref="#/components/schemas/PostPredictedSentiment",
 *         description="The predicted sentiment for the post"
 *     ),
 *     @OA\Property(
 *         property="post_predicted_emotion",
 *         ref="#/components/schemas/PostPredictedEmotion",
 *         description="The predicted emotion for the post"
 *     )
 * )
 */

class PostAnalytic {}
