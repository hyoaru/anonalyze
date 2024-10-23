<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SignUpRequest",
 *     type="object",
 *     required={"first_name", "last_name", "email", "password", "password_confirmation"},
 *     @OA\Property(property="first_name", type="string", description="The first name of the user"),
 *     @OA\Property(property="last_name", type="string", description="The last name of the user"),
 *     @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 *     @OA\Property(property="password", type="string", description="The password of the user"),
 *     @OA\Property(property="password_confirmation", type="string", description="Confirmation of the user's password")
 * )
 */
class SignUpRequest {}
