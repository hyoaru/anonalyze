<?php

namespace App\OpenApi\Schemas\Threads;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreThreadRequest",
 *     type="object",
 *     required={"question"},
 *     @OA\Property(property="question", type="string", description="The question of the thread")
 * )
 */
class StoreThreadRequest {}
