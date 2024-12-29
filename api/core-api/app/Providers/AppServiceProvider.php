<?php

namespace App\Providers;

use App\Repositories\EmotionRepository\EmotionRepository;
use App\Repositories\EmotionRepository\EmotionRepositoryInterface;
use App\Services\EmotionService\EmotionService;
use App\Services\EmotionService\EmotionServiceInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
