<?php

namespace App\OpenApi\Schemas\Authentication;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SignUpResponse",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         @OA\Property(property="message", type="string", description="Success message"),
 *         @OA\Property(
 *             property="user",
 *             type="object",
 *             @OA\Property(property="first_name", type="string", description="The first name of the user"),
 *             @OA\Property(property="last_name", type="string", description="The last name of the user"),
 *             @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", description="The timestamp when the user was last updated"),
 *             @OA\Property(property="created_at", type="string", format="date-time", description="The timestamp when the user was created"),
 *             @OA\Property(property="id", type="integer", description="The unique identifier of the user")
 *         ),
 *         @OA\Property(property="token", type="string", description="The authentication token for the user")
 *     )
 * )
 */
class SignUpResponse {}