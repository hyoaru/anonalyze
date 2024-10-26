<?php

namespace App\OpenApi\Schemas\Posts;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     required={"id", "thread_id", "content", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="thread_id", type="integer", format="int64"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="thread",
 *         ref="#/components/schemas/Thread",
 *         description="The thread this post belongs to"
 *     ),
 *     @OA\Property(
 *         property="post_analytic",
 *         ref="#/components/schemas/PostAnalytic",
 *         description="The analytic data for the post"
 *     )
 * )
 */

class Post {}
