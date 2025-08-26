<?php

namespace App\Observers;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Model;

class CacheObserver
{
    /**
     * Handle model saved events
     */
    public function saved(Model $model): void
    {
        $this->invalidateCaches($model);
    }

    /**
     * Handle model deleted events
     */
    public function deleted(Model $model): void
    {
        $this->invalidateCaches($model);
    }

    /**
     * Handle model restored events
     */
    public function restored(Model $model): void
    {
        $this->invalidateCaches($model);
    }

    /**
     * Invalidate relevant caches based on model type
     */
    protected function invalidateCaches(Model $model): void
    {
        $modelClass = get_class($model);

        switch ($modelClass) {
            case 'App\Models\Product':
                $this->invalidateProductCaches($model);
                break;
            case 'App\Models\Review':
                $this->invalidateReviewCaches($model);
                break;
            case 'App\Models\Order':
                $this->invalidateOrderCaches($model);
                break;
        }

        // Always clear common view data cache
        CacheService::forget('common_view_data');
    }

    /**
     * Invalidate product-related caches
     */
    protected function invalidateProductCaches($product): void
    {
        CacheService::clearTag('products');
        CacheService::clearTag('navigation'); // Header menu uses products
        CacheService::clearTag('home'); // Home page uses products
        CacheService::clearTag('components'); // Product cards cache
        
        // Clear specific product caches
        $specificKeys = [
            'products:active',
            'products:featured',
            'products:featured:limit:1',
            'products:featured:limit:2', 
            'products:regular',
            'products:regular:limit:3',
            'products:price_stats',
            'products:castor_oil',
        ];

        foreach ($specificKeys as $key) {
            CacheService::forget($key);
        }
    }

    /**
     * Invalidate review-related caches
     */
    protected function invalidateReviewCaches($review): void
    {
        CacheService::clearTag('reviews');
        CacheService::clearTag('home'); // Home page uses reviews
        CacheService::clearTag('components'); // Testimonial cards cache
        
        // Clear specific review caches
        $specificKeys = [
            'reviews:featured',
            'reviews:active',
        ];

        foreach ($specificKeys as $key) {
            CacheService::forget($key);
        }
    }

    /**
     * Invalidate order-related caches
     */
    protected function invalidateOrderCaches($order): void
    {
        // Orders might affect statistics or product popularity
        CacheService::clearTag('products');
        CacheService::forget('common_view_data');
    }
}