<?php

namespace App\Providers;

use App\View\Composers\CacheComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register cache service in container
        $this->app->singleton(\App\Services\CacheService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register view composers for caching
        View::composer([
            'components.footer',
            'components.testimonial-card', 
            'components.product-card',
            'components.social-proof',
            'components.stats-grid',
        ], CacheComposer::class);
    }
}
