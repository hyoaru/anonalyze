<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ShowPostAnalyticResponse",
 *     type="object",
 *     title="Show Post Analytic Response",
 *     @OA\Property(
 *        property="data", 
 *        type="object",
 *        @OA\Property(
 *          property="post",
 *          ref="#/components/schemas/PostAnalytic"
 *        ),
 *     ),  
 * )
 */

class ShowPostAnalyticResponse {}
