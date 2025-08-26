<?php

namespace App\View\Composers;

use App\Services\CacheService;
use App\Models\Product;
use App\Models\Review;
use Illuminate\View\View;

class CacheComposer
{
    /**
     * Compose common cached data for views
     */
    public function compose(View $view): void
    {
        // Only add data to specific views to avoid overhead
        $viewName = $view->getName();
        
        if ($this->shouldAddCachedData($viewName)) {
            $view->with($this->getCachedCommonData());
        }
    }

    /**
     * Determine if we should add cached data to this view
     */
    protected function shouldAddCachedData(string $viewName): bool
    {
        $cachedViews = [
            'components.footer',
            'components.testimonial-card',
            'components.product-card',
            'components.social-proof',
            'components.stats-grid',
        ];

        return in_array($viewName, $cachedViews);
    }

    /**
     * Get common cached data
     */
    protected function getCachedCommonData(): array
    {
        return CacheService::rememberView('common_view_data', function () {
            return [
                'total_products' => Product::where('is_active', true)->count(),
                'featured_products_count' => Product::where('is_active', true)
                    ->where('is_featured', true)->count(),
                'total_reviews' => Review::where('is_active', true)->count(),
            ];
        });
    }
}