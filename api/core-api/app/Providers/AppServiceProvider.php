<?php

namespace App\Providers;

use App\Repositories\EmotionRepository\EmotionRepository;
use App\Repositories\EmotionRepository\EmotionRepositoryInterface;
use App\Repositories\SentimentRepository\SentimentRepository;
use App\Repositories\SentimentRepository\SentimentRepositoryInterface;
use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepository;
use App\Repositories\ThreadAnalyticRepository\ThreadAnalyticRepositoryInterface;
use App\Services\EmotionService\EmotionService;
use App\Services\EmotionService\EmotionServiceInterface;
use App\Services\SentimentService\SentimentService;
use App\Services\SentimentService\SentimentServiceInterface;
use App\Services\ThreadAnalyticService\ThreadAnalyticService;
use App\Services\ThreadAnalyticService\ThreadAnalyticServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmotionRepositoryInterface::class, EmotionRepository::class);
        $this->app->bind(EmotionServiceInterface::class, EmotionService::class);
        $this->app->bind(SentimentRepositoryInterface::class, SentimentRepository::class);
        $this->app->bind(SentimentServiceInterface::class, SentimentService::class);
        $this->app->bind(ThreadAnalyticRepositoryInterface::class, ThreadAnalyticRepository::class);
        $this->app->bind(ThreadAnalyticServiceInterface::class, ThreadAnalyticService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
