<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

 /**
 * @OA\Schema(
 *     schema="ThreadExtractedConcept",
 *     type="object",
 *     title="Thread Extracted Concept",
 *     required={"id", "thread_extracted_concept_group_id", "concept", "significance_score", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="thread_extracted_concept_group_id", type="integer", format="int64"),
 *     @OA\Property(property="concept", type="string"),
 *     @OA\Property(property="significance_score", type="number", format="float"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

class ThreadExtractedConcept {}
