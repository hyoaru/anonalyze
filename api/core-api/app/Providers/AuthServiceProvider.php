<?php

namespace App\Providers;

use App\Models\Emotion;
use App\Models\Post;
use App\Models\PostPredictedSentiment;
use App\Models\Sentiment;
use App\Models\Thread;
use App\Models\ThreadSummary;
use App\Policies\EmotionPolicy;
use App\Policies\PostPolicy;
use App\Policies\PostPredictedSentimentPolicy;
use App\Policies\SentimentPolicy;
use App\Policies\ThreadPolicy;
use App\Policies\ThreadSummaryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Thread::class => ThreadPolicy::class,
        ThreadSummary::class => ThreadSummaryPolicy::class,
        Post::class => PostPolicy::class,
        Emotion::class => EmotionPolicy::class,
        Sentiment::class => SentimentPolicy::class,
        PostPredictedSentiment::class => PostPredictedSentimentPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
