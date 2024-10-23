<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SignInRequest",
 *     type="object",
 *     required={"email", "password"},
 *     @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 *     @OA\Property(property="password", type="string", description="The password of the user"),
 * )
 */
class SignInRequest {}
