<?php

namespace App\Utilities\HttpClient;

use Exception;
use Illuminate\Support\Facades\Http;

class MlApiHttpClient
{
    protected static string $baseUrl = env(
        'ML_API_URL',
        'http://anonalyze_api_ml:8003'
    );

    protected static array $headers = [
        'Acept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    public static function get(string $route)
    {
        $response = Http::withHeaders(self::$headers)->get(self::$baseUrl.$route);
        throw_if(! $response->successful(), new Exception('An error has occured'));

        return $response->json();
    }

    public static function post(string $route, array $payload)
    {
        $response = Http::withHeaders(self::$headers)->post(self::$baseUrl.$route, $payload);
        throw_if(! $response->successful(), new Exception('An error has occured'));

        return $response->json();
    }
}
