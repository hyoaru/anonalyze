<?php

namespace App;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Anonalyze Core API",
 *     version="1.0.0",
 *     @OA\Contact(name="hyoaru"),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="Bearer",
 *     in="header",
 *     name="Bearer",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter your Bearer token in the format **Bearer <token>**"
 * )
 */
class OpenApi {}
