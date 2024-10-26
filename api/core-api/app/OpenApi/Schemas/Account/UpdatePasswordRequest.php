<?php

namespace App\OpenApi\Schemas\Account;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UpdatePasswordRequest",
 *     type="object",
 *     required={"current_password", "new_password"},
 *     @OA\Property(property="current_password", type="string", description="The current password of the user"),
 *     @OA\Property(property="new_password", type="string", description="The new password of the user"),
 * )
 */
class UpdatePasswordRequest {}
