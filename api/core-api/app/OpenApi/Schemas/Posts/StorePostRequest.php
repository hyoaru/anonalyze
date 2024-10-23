<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StorePostRequest",
 *     type="object",
 *     required={"thread_id", "content"},
 *     @OA\Property(property="thread_id", type="integer", description="The unique identifier of the associated thread"),
 *     @OA\Property(property="content", type="string", description="The content of the post")
 * )
 */
class StorePostRequest {}
