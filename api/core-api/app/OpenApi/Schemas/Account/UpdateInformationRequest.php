<?php

namespace App\OpenApi\Schemas\Account;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UpdateInformationRequest",
 *     type="object",
 *     required={"first_name", "last_name"},
 *     @OA\Property(property="first_name", type="string", description="The first name of the user"),
 *     @OA\Property(property="last_name", type="string", description="The last name of the user"),
 * )
 */
class UpdateInformationRequest {}
