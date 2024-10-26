<?php

namespace App\OpenApi\Schemas\Sentiments;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Sentiment",
 *     type="object",
 *     title="Sentiment",
 *     required={"id", "class", "description", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="class", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 */
class Sentiment {}