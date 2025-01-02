<?php

namespace App\Providers;

use App\Repositories\EmotionRepository\EmotionRepository;
use App\Repositories\EmotionRepository\EmotionRepositoryInterface;
use App\Repositories\MachineLearning\ConceptExtractionRepository\ConceptExtractionRepository;
use App\Repositories\MachineLearning\ConceptExtractionRepository\ConceptExtractionRepositoryInterface;
use App\Repositories\MachineLearning\EmotionClassificationRepository\EmotionClassificationRepository;
use App\Repositories\MachineLearning\EmotionClassificationRepository\EmotionClassificationRepositoryInterface;
use App\Repositories\MachineLearning\SentimentClassificationRepository\SentimentClassificationRepository;
use App\Repositories\MachineLearning\SentimentClassificationRepository\SentimentClassificationRepositoryInterface;
use App\Repositories\PostAnalyticRepository\PostAnalyticRepository;
use App\Repositories\PostAnalyticRepository\PostAnalyticRepositoryInterface;
use App\Repositories\PostPredictedEmotionRepository\PostPredictedEmotionRepository;
use App\Repositories\PostPredictedEmotionRepository\PostPredictedEmotionRepositoryInterface;
use App\Repositories\PostPredictedSentimentRepository\PostPredictedSentimentRepository;
use App\Repositories\PostPredictedSentimentRepository\PostPredictedSentimentRepositoryInterface;
use App\Repositories\PostRepository\PostRepository;
use App\Repositories\PostRepository\PostRepositoryInterface;
use App\Repositories\SentimentRepository\SentimentRepository;
use App\Repositories\SentimentRepository\SentimentRepositoryInterface;
use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepository;
use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepositoryInterface;
use App\Repositories\ThreadExtractedConceptGroupRepository\ThreadExtractedConceptGroupRepository;
use App\Repositories\ThreadExtractedConceptGroupRepository\ThreadExtractedConceptGroupRepositoryInterface;
use App\Repositories\ThreadRepository\ThreadRepository;
use App\Repositories\ThreadRepository\ThreadRepositoryInterface;
use App\Services\EmotionService\EmotionService;
use App\Services\EmotionService\EmotionServiceInterface;
use App\Services\MachineLearning\ConceptExtractionService\ConceptExtractionService;
use App\Services\MachineLearning\ConceptExtractionService\ConceptExtractionServiceInterface;
use App\Services\PostAnalyticService\PostAnalyticService;
use App\Services\PostAnalyticService\PostAnalyticServiceInterface;
use App\Services\PostService;
use App\Services\PostService\PostServiceInterface;
use App\Services\SentimentService\SentimentService;
use App\Services\SentimentService\SentimentServiceInterface;
use App\Services\ThreadAnalyticService\ThreadAnalyticService;
use App\Services\ThreadAnalyticService\ThreadAnalyticServiceInterface;
use App\Services\ThreadExtractedConceptGroupService\ThreadExtractedConceptGroupService;
use App\Services\ThreadExtractedConceptGroupService\ThreadExtractedConceptGroupServiceInterface;
use App\Services\ThreadService\ThreadService;
use App\Services\ThreadService\ThreadServiceInterface;
use App\Utilities\HttpClient\MlApiHttpClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Emotion
        $this->app->bind(EmotionRepositoryInterface::class, EmotionRepository::class);
        $this->app->bind(EmotionServiceInterface::class, EmotionService::class);

        // Sentiment
        $this->app->bind(SentimentRepositoryInterface::class, SentimentRepository::class);
        $this->app->bind(SentimentServiceInterface::class, SentimentService::class);

        // Thread analytic
        $this->app->bind(ThreadAnalyticRepositoryInterface::class, ThreadAnalyticRepository::class);
        $this->app->bind(ThreadAnalyticServiceInterface::class, ThreadAnalyticService::class);

        // Thread
        $this->app->bind(ThreadRepositoryInterface::class, ThreadRepository::class);
        $this->app->bind(ThreadServiceInterface::class, ThreadService::class);

        // Thread extracted concept group
        $this->app->bind(ThreadExtractedConceptGroupRepositoryInterface::class, ThreadExtractedConceptGroupRepository::class);
        $this->app->bind(ThreadExtractedConceptGroupServiceInterface::class, ThreadExtractedConceptGroupService::class);

        // Post
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);

        // Post analytic
        $this->app->bind(PostAnalyticRepositoryInterface::class, PostAnalyticRepository::class);
        $this->app->bind(PostAnalyticServiceInterface::class, PostAnalyticService::class);

        // Post predicted sentiment
        $this->app->bind(PostPredictedSentimentRepositoryInterface::class, PostPredictedSentimentRepository::class);

        // Post predicted emotion
        $this->app->bind(PostPredictedEmotionRepositoryInterface::class, PostPredictedEmotionRepository::class);

        // ML API HTTP Client
        $this->app->singleton(MlApiHttpClient::class, fn () => new MlApiHttpClient());

        // ML API: Concept Extraction
        $this->app->bind(ConceptExtractionRepositoryInterface::class, ConceptExtractionRepository::class);
        $this->app->bind(ConceptExtractionServiceInterface::class, ConceptExtractionService::class);

        // ML API: Emotion Classification
        $this->app->bind(EmotionClassificationRepositoryInterface::class, EmotionClassificationRepository::class);

        // ML API: Sentiment Classification
        $this->app->bind(SentimentClassificationRepositoryInterface::class, SentimentClassificationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
