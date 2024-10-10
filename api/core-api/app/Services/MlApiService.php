<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Throw_;

class MlApiService {
    protected static $baseUrl = null;

    protected static function getBaseUrl() {
        if (self::$baseUrl === null) {
            self::$baseUrl = env('ML_API_URL');
        }
        return self::$baseUrl;
    }

    protected static function httpPost(string $route, array $payload) {
        $apiEndpoint = self::getBaseUrl() . $route;
        $headers = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];

        return Http::withHeaders($headers)->post($apiEndpoint, $payload);
    }

    public static function predictSentiment(string $text) {
        return self::httpPost("/sentiment/predict", ['text' => $text]);
    }

    public static function predictEmotion(string $text) {
        return self::httpPost("/emotion/predict", ['text' => $text]);
    }

    public static function extractConcepts(array $postContents) {
        return self::httpPost('/concept/extract', ['texts' => $postContents]);
    }
}
