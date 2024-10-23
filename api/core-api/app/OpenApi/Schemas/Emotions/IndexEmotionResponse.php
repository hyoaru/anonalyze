<?php

namespace App\OpenApi\Schemas\Emotions;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="IndexEmotionResponse",
 *     type="object",
 *     title="Emotion Response",
 *     @OA\Property(
 *        property="data", 
 *        type="array",
 *        @OA\Items(ref="#/components/schemas/Emotion"),
 *     ),  
 * )
 */

class IndexEmotionResponse {}
