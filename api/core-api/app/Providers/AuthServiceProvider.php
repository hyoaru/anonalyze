<?php

namespace App\Providers;

use App\Models\Sentiment;
use App\Models\Emotion;
use App\Models\Posts\Post;
use App\Models\Posts\PostAnalytic;
use App\Models\Posts\PostPredictedEmotion;
use App\Models\Posts\PostPredictedSentiment;
use App\Models\Threads\Thread;
use App\Models\Threads\ThreadAnalytic;
use App\Models\Threads\ThreadExtractedConcept;
use App\Models\Threads\ThreadExtractedConceptGroup;
use App\Models\Threads\ThreadSummary;
use App\Models\User;
use App\Policies\AccountPolicy;
use App\Policies\EmotionPolicy;
use App\Policies\SentimentPolicy;
use App\Policies\Posts\PostAnalyticPolicy;
use App\Policies\Posts\PostPolicy;
use App\Policies\Posts\PostPredictedEmotionPolicy;
use App\Policies\Posts\PostPredictedSentimentPolicy;
use App\Policies\Threads\ThreadAnalyticPolicy;
use App\Policies\Threads\ThreadExtractedConceptGroupPolicy;
use App\Policies\Threads\ThreadExtractedConceptPolicy;
use App\Policies\Threads\ThreadPolicy;
use App\Policies\Threads\ThreadSummaryPolicy;

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
        PostPredictedEmotion::class => PostPredictedEmotionPolicy::class,
        PostAnalytic::class => PostAnalyticPolicy::class,
        ThreadExtractedConceptGroup::class => ThreadExtractedConceptGroupPolicy::class,
        ThreadExtractedConcept::class => ThreadExtractedConceptPolicy::class,
        ThreadAnalytic::class => ThreadAnalyticPolicy::class,
        User::class => AccountPolicy::class,
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
