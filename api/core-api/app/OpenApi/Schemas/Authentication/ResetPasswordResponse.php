<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ResetPasswordResponse",
 *     type="object",
 *
 *     @OA\Property(ref="#/components/schemas/User")
 * )
 */
class ResetPasswordResponse {}
