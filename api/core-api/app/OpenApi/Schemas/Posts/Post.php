<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     required={"thread_id", "content"},
 *     @OA\Property(property="id", type="integer", format="int64", description="The unique identifier of the post"),
 *     @OA\Property(property="thread_id", type="integer", format="int64", description="The unique identifier of the associated thread"),
 *     @OA\Property(property="content", type="string", description="The content of the post"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="The date when the post was created"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="The date when the post was last updated")
 * )
 */
class Post {}
