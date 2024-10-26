<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"id", "first_name", "last_name", "email", "updated_at", "created_at"},
 *     @OA\Property(property="id", type="integer", description="The unique identifier of the user"),
 *     @OA\Property(property="first_name", type="string", description="The first name of the user"),
 *     @OA\Property(property="last_name", type="string", description="The last name of the user"),
 *     @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="The timestamp when the user was last updated"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="The timestamp when the user was created"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", description="The timestamp when the user's email was verified")
 * )
 */
class User {}