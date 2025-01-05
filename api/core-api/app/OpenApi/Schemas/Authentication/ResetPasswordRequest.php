<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ResetPasswordRequest",
 *     type="object",
 *     required={"email", "token", "password"},
 *
 *     @OA\Property(property="email", type="string", format="email", description="User's email address"),
 *     @OA\Property(property="token", type="string", description="Password reset token"),
 *     @OA\Property(property="password", type="string", description="New password"),
 * )
 */
class ResetPasswordRequest {}
