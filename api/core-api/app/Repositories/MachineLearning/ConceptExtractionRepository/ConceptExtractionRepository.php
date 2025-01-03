<?php

namespace App\Repositories\MachineLearning\ConceptExtractionRepository;

use App\Utilities\HttpClient\MlApiHttpClient;

class ConceptExtractionRepository implements ConceptExtractionRepositoryInterface
{
    protected MlApiHttpClient $mlApiHttpClient;

    public function __construct(MlApiHttpClient $mlApiHttpClient)
    {
        $this->mlApiHttpClient = $mlApiHttpClient;
    }

    public function extract(string $text): array
    {
        $response = $this->mlApiHttpClient->post('/concept/extract', ['text' => $text]);

        return $response['data']['extracted_concepts'];
    }
}
