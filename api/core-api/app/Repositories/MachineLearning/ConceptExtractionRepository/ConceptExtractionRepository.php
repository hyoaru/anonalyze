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

    public function extract(array $texts): array
    {
        $response = $this->mlApiHttpClient->post('/concept/extract', ['texts' => $texts]);

        return $response['data']['extracted_concepts'];
    }
}
