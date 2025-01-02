<?php

namespace App\Repositories\MachineLearning\ConceptExtractionRepository;

use App\Utilities\HttpClient\MlApiHttpClient;

class ConceptExtractionRepository implements ConceptExtractionRepositoryInterface
{
    public function extract(array $sentences): array
    {
        $response = MlApiHttpClient::post('/concept/extract', ['texts' => $sentences]);

        return $response['data']['extracted_concepts'];
    }
}
