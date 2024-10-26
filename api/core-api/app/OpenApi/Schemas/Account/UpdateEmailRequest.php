<?php

namespace App\OpenApi\Schemas\Account;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UpdateEmailRequest",
 *     type="object",
 *     required={"new_email", "password"},
 *     @OA\Property(property="new_email", type="string", description="The new email of the user"),
 *     @OA\Property(property="password", type="string", description="The password of the user"),
 * )
 */
class UpdateEmailRequest {}
