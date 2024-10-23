<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ThreadSummary",
 *     type="object",
 *     title="Thread Summary",
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="thread_id", type="integer", format="int64"),
 *     @OA\Property(property="summary", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="thread",
 *         ref="#/components/schemas/Thread",
 *         description="The thread this summary belongs to"
 *     )
 * )
 */

class ThreadSummary {}
