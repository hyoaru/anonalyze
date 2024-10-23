<?php

namespace App\OpenApi\Schemas\Sentiments;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="IndexSentimentResponse",
 *     type="object",
 *     title="Sentiment Response",
 *     @OA\Property(
 *        property="data", 
 *        type="array",
 *        @OA\Items(ref="#/components/schemas/Sentiment"),
 *     ),  
 * )
 */

class IndexSentimentResponse {}
