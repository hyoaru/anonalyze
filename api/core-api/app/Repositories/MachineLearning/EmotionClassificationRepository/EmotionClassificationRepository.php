<?php

namespace App\Repositories\MachineLearning\EmotionClassificationRepository;

use App\Utilities\HttpClient\MlApiHttpClient;

class EmotionClassificationRepository implements EmotionClassificationRepositoryInterface
{
    protected MlApiHttpClient $mlApiHttpClient;

    public function __construct(MlApiHttpClient $mlApiHttpClient)
    {
        $this->mlApiHttpClient = $mlApiHttpClient;
    }

    public function classify(string $text): array
    {
        $response = $this->mlApiHttpClient->post('/emotion/predict', ['text' => $text]);

        return $response['data']['predicted_value'];
    }
}
