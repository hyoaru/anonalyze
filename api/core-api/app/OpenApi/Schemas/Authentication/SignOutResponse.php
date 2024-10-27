<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SignOutResponse",
 *     type="object",
 *     @OA\Property(ref="#/components/schemas/User")
 * )
 */
class SignOutResponse {}
