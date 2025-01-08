<?php

namespace App\Utilities\HttpClient;

use Exception;
use Illuminate\Support\Facades\Http;

class MlApiHttpClient
{
    private static ?MlApiHttpClient $instance = null;

    private string $baseUrl;

    private array $headers;

    public function __construct()
    {
        $this->baseUrl = env(
            'ML_API_URL',
            'http://localhost:8003'
        );

        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public static function getInstance(): MlApiHttpClient
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function get(string $route)
    {
        $response = Http::withHeaders($this->headers)->get($this->baseUrl.$route);
        throw_if(! $response->successful(), new Exception('An error has occured'));

        return $response->json();
    }

    public function post(string $route, array $payload)
    {
        $response = Http::withHeaders($this->headers)->post($this->baseUrl.$route, $payload);
        throw_if(! $response->successful(), new Exception('An error has occured'));

        return $response->json();
    }
}
