<?php

namespace App\Repositories\MachineLearning\SentimentClassificationRepository;

use App\Utilities\HttpClient\MlApiHttpClient;

class SentimentClassificationRepository implements SentimentClassificationRepositoryInterface
{
    protected MlApiHttpClient $mlApiHttpClient;

    public function __construct(MlApiHttpClient $mlApiHttpClient)
    {
        $this->mlApiHttpClient = $mlApiHttpClient;
    }

    public function classify(string $text): array
    {
        $response = $this->mlApiHttpClient->post('/sentiment/predict', ['text' => $text]);

        return $response['data']['predicted_value'];
    }
}
