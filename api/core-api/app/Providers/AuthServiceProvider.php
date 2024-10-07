<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Thread;
use App\Models\ThreadSummary;
use App\Policies\PostPolicy;
use App\Policies\ThreadPolicy;
use App\Policies\ThreadSummaryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Thread::class => ThreadPolicy::class,
        ThreadSummary::class => ThreadSummaryPolicy::class,
        Post::class => PostPolicy::class,
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
