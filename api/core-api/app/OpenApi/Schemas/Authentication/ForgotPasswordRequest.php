<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ForgotPasswordRequest",
 *     type="object",
 *     required={"email"},
 *
 *     @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 * )
 */
class ForgotPasswordRequest {}
