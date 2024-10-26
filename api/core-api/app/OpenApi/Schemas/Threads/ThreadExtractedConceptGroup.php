<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ThreadExtractedConceptGroup",
 *     type="object",
 *     title="Thread Extracted Concept Group",
 *     required={"id", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="thread_extracted_concepts",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/ThreadExtractedConcept"),
 *         description="A list of extracted concepts for this group"
 *     )
 * )
 */

class ThreadExtractedConceptGroup {}
