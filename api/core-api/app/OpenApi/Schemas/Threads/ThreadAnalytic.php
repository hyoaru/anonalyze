<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ThreadAnalytic",
 *     type="object",
 *     title="Thread Analytic",
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="thread_id", type="integer", format="int64"),
 *     @OA\Property(property="thread_extracted_concept_group_id", type="integer", format="int64"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="thread",
 *         ref="#/components/schemas/Thread",
 *         description="The thread this analytic belongs to"
 *     ),
 *     @OA\Property(
 *         property="thread_extracted_concept_group",
 *         ref="#/components/schemas/ThreadExtractedConceptGroup",
 *         description="The extracted concept group for the thread"
 *     )
 * )
 */


class ThreadAnalytic {}
