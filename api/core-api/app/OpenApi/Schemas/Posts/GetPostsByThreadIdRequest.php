<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GetPostsByThreadIdRequest",
 *     type="object",
 *     required={"thread_id"},
 *     @OA\Property(property="thread_id", type="integer", description="The unique identifier of the associated thread"),
 * )
 */
class GetPostsByThreadIdRequest {}
