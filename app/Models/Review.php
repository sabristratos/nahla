<?php

namespace App\Models;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'review_text_ar',
        'rating',
        'location',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get cached featured testimonials
     */
    public static function getCachedFeatured()
    {
        $ttl = config('cache-control.ttl.reviews.featured');
        
        return CacheService::rememberReviews('reviews:featured', function () {
            return static::where('is_featured', true)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        }, $ttl);
    }

    /**
     * Get cached active reviews
     */
    public static function getCachedActive(int $limit = null)
    {
        $key = 'reviews:active' . ($limit ? ":limit:{$limit}" : '');
        
        return CacheService::rememberReviews($key, function () use ($limit) {
            $query = static::where('is_active', true)->orderBy('sort_order');
            
            if ($limit) {
                $query->take($limit);
            }
            
            return $query->get();
        });
    }

    /**
     * Clear review caches when model is updated
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            CacheService::clearTag('reviews');
        });

        static::deleted(function () {
            CacheService::clearTag('reviews');
        });
    }
}
