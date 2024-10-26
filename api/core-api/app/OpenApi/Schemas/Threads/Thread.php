<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Thread",
 *     type="object",
 *     title="Thread",
 *     required={"id", "user_id", "question", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="user_id", type="integer", format="int64"),
 *     @OA\Property(property="question", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="posts",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Post"),
 *         description="A list of posts in the thread"
 *     ),
 *     @OA\Property(
 *         property="thread_analytic",
 *         ref="#/components/schemas/ThreadAnalytic",
 *         description="The analytic data of the thread"
 *     )
 * )
 */


class Thread {}
