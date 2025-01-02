<?php

namespace App\Providers;

use App\Repositories\EmotionRepository\EmotionRepository;
use App\Repositories\EmotionRepository\EmotionRepositoryInterface;
use App\Repositories\MachineLearning\ConceptExtractionRepository\ConceptExtractionRepository;
use App\Repositories\MachineLearning\ConceptExtractionRepository\ConceptExtractionRepositoryInterface;
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
use App\Services\SentimentService\SentimentService;
use App\Services\SentimentService\SentimentServiceInterface;
use App\Services\ThreadAnalyticService\ThreadAnalyticService;
use App\Services\ThreadAnalyticService\ThreadAnalyticServiceInterface;
use App\Services\ThreadExtractedConceptGroupService\ThreadExtractedConceptGroupService;
use App\Services\ThreadExtractedConceptGroupService\ThreadExtractedConceptGroupServiceInterface;
use App\Services\ThreadService\ThreadService;
use App\Services\ThreadService\ThreadServiceInterface;
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

        // ML API: Concept Extraction
        $this->app->bind(ConceptExtractionRepositoryInterface::class, ConceptExtractionRepository::class);
        $this->app->bind(ConceptExtractionServiceInterface::class, ConceptExtractionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
