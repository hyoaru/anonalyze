<?php

namespace App\Repositories\MachineLearning\SummarizationRepository;

use App\Utilities\HttpClient\MlApiHttpClient;

class SummarizationRepository implements SummarizationRepositoryInterface
{
    protected MlApiHttpClient $mlApiHttpClient;

    public function __construct(MlApiHttpClient $mlApiHttpClient)
    {
        $this->mlApiHttpClient = $mlApiHttpClient;
    }

    public function summarize(string $text): string
    {
        $response = $this->mlApiHttpClient->post('/summary/summarize', ['text' => $text]);

        return $response['summary'];
    }
}
