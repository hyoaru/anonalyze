<?php

namespace App\OpenApi\Schemas\Account;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UpdatePasswordRequest",
 *     type="object",
 *     required={"current_password", "new_password", "new_password_confirmation"},
 *
 *     @OA\Property(property="current_password", type="string", description="The current password of the user"),
 *     @OA\Property(property="new_password", type="string", description="The new password of the user"),
 *     @OA\Property(property="new_password_confirmation", type="string", description="The new password confirmation of the user")
 * )
 */
class UpdatePasswordRequest {}
