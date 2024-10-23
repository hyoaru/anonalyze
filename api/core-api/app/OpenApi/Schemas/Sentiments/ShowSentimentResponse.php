<?php

namespace App\OpenApi\Schemas\Sentiments;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ShowSentimentResponse",
 *     type="object",
 *     title="Show Sentiment Response",
 *     @OA\Property(
 *        property="data", 
 *        type="object",
 *        @OA\Property(
 *          property="sentiment",
 *          ref="#/components/schemas/Sentiment"
 *        ),
 *     ),  
 * )
 */

class ShowSentimentResponse {}
