<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SendResetPasswordConfirmationRequest",
 *     type="object",
 *     required={"email"},
 *
 *     @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 * )
 */
class SendResetPasswordConfirmationRequest {}
