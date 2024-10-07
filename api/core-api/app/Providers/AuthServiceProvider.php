<?php

namespace App\Providers;

use App\Models\Thread;
use App\Models\ThreadSummary;
use App\Policies\ThreadPolicy;
use App\Policies\ThreadSummaryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Thread::class => ThreadPolicy::class,
        ThreadSummary::class => ThreadSummaryPolicy::class,
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
