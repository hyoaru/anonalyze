<?php

namespace App\OpenApi\Schemas\Emotions;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ShowEmotionResponse",
 *     type="object",
 *     title="Show Emotion Response",
 *     @OA\Property(
 *        property="data", 
 *        type="object",
 *        @OA\Property(
 *          property="emotion",
 *          ref="#/components/schemas/Emotion"
 *        ),
 *     ),  
 * )
 */

class ShowEmotionResponse {}
