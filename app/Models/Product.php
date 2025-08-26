<?php

namespace App\Models;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'description_ar',
        'ingredients_ar',
        'usage_ar',
        'benefits_ar',
        'price',
        'size',
        'image_path',
        'additional_images',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'additional_images' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get cached active products
     */
    public static function getCachedActive()
    {
        return CacheService::rememberProducts('products:active', function () {
            return static::where('is_active', true)->orderBy('sort_order')->get();
        });
    }

    /**
     * Get cached featured products
     */
    public static function getCachedFeatured(int $limit = null)
    {
        $key = 'products:featured' . ($limit ? ":limit:{$limit}" : '');
        $ttl = config('cache-control.ttl.products.featured');
        
        return CacheService::rememberProducts($key, function () use ($limit) {
            $query = static::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('sort_order');
                
            if ($limit) {
                $query->take($limit);
            }
            
            return $query->get();
        }, $ttl);
    }

    /**
     * Get cached regular (non-featured) products
     */
    public static function getCachedRegular(int $limit = null)
    {
        $key = 'products:regular' . ($limit ? ":limit:{$limit}" : '');
        
        return CacheService::rememberProducts($key, function () use ($limit) {
            $query = static::where('is_active', true)
                ->where('is_featured', false)
                ->orderBy('sort_order');
                
            if ($limit) {
                $query->take($limit);
            }
            
            return $query->get();
        });
    }

    /**
     * Get cached price statistics
     */
    public static function getCachedPriceStats()
    {
        $ttl = config('cache-control.ttl.products.price_stats');
        
        return CacheService::rememberProducts('products:price_stats', function () {
            return static::where('is_active', true)
                ->selectRaw('MIN(price) as min_price, MAX(price) as max_price, COUNT(*) as total_count')
                ->first();
        }, $ttl);
    }

    /**
     * Get cached castor oil product
     */
    public static function getCachedCastorOil()
    {
        return CacheService::rememberProducts('products:castor_oil', function () {
            $castorOil = static::where('is_active', true)
                ->where('name_ar', 'LIKE', '%خروع%')
                ->first();

            // Fallback to featured or first product
            if (!$castorOil) {
                $castorOil = static::where('is_active', true)
                    ->where('is_featured', true)
                    ->first() ?: static::where('is_active', true)->first();
            }

            return $castorOil;
        });
    }

    /**
     * Clear product caches when model is updated
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            CacheService::clearTag('products');
        });

        static::deleted(function () {
            CacheService::clearTag('products');
        });
    }
}
