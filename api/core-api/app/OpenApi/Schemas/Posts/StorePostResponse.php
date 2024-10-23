<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StorePostResponse",
 *     type="object",
 *     title="Post Response",
 *     @OA\Property(
 *        property="data", 
 *        type="object",
 *        @OA\Property(
 *          property="post",
 *          ref="#/components/schemas/Post"
 *        ),
 *     ),  
 * )
 */

class StorePostResponse {}
