<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SignInResponse",
 *     type="object",
 *     required={"message", "user", "token"},
 *     @OA\Property(property="message", type="string", description="Success message"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/User"
 *     ),
 *     @OA\Property(property="token", type="string", description="The authentication token for the user")
 * )
 */
class SignInResponse {}