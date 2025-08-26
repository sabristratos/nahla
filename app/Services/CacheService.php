<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Cache\Repository;

class CacheService
{
    /**
     * Check if caching is globally enabled
     */
    public static function isEnabled(): bool
    {
        return config('cache-control.enabled', true);
    }

    /**
     * Get cache with global control and monitoring
     */
    public static function remember(string $key, $ttl, \Closure $callback, ?string $tag = null, ?string $store = null)
    {
        if (!self::isEnabled()) {
            return $callback();
        }

        $key = self::buildKey($key, $tag);
        $store = $store ?: config('cache.default');
        $cacheStore = Cache::store($store);

        // Store tag mapping for non-tagging cache stores
        if ($tag && !self::supportsTagging($cacheStore)) {
            self::addKeyToTag($key, $tag);
        }

        // Apply tags if supported and provided
        if ($tag && self::supportsTagging($cacheStore)) {
            try {
                $cacheStore = $cacheStore->tags([config('cache-control.tags.' . $tag, $tag)]);
            } catch (\Exception $e) {
                // If tagging fails, fall back to individual key tracking
                self::addKeyToTag($key, $tag);
            }
        }

        $startTime = microtime(true);
        $hit = $cacheStore->has($key);
        
        $result = $cacheStore->remember($key, $ttl, $callback);
        
        self::logPerformance($key, $hit, microtime(true) - $startTime);
        
        return $result;
    }

    /**
     * Get cached value with global control
     */
    public static function get(string $key, $default = null, ?string $store = null)
    {
        if (!self::isEnabled()) {
            return $default;
        }

        $key = self::buildKey($key);
        $store = $store ?: config('cache.default');
        
        return Cache::store($store)->get($key, $default);
    }

    /**
     * Put value in cache with global control
     */
    public static function put(string $key, $value, $ttl, ?string $tag = null, ?string $store = null): bool
    {
        if (!self::isEnabled()) {
            return true; // Return true to not break application flow
        }

        $key = self::buildKey($key, $tag);
        $store = $store ?: config('cache.default');
        $cacheStore = Cache::store($store);

        // Store tag mapping for non-tagging cache stores
        if ($tag && !self::supportsTagging($cacheStore)) {
            self::addKeyToTag($key, $tag);
        }

        // Apply tags if supported and provided
        if ($tag && self::supportsTagging($cacheStore)) {
            try {
                $cacheStore = $cacheStore->tags([config('cache-control.tags.' . $tag, $tag)]);
            } catch (\Exception $e) {
                // If tagging fails, fall back to individual key tracking
                self::addKeyToTag($key, $tag);
            }
        }

        return $cacheStore->put($key, $value, $ttl);
    }

    /**
     * Forget cached value
     */
    public static function forget(string $key, ?string $store = null): bool
    {
        $key = self::buildKey($key);
        $store = $store ?: config('cache.default');
        
        return Cache::store($store)->forget($key);
    }

    /**
     * Clear cache by tag
     */
    public static function clearTag(string $tag, ?string $store = null): bool
    {
        if (!self::isEnabled()) {
            return true;
        }

        $store = $store ?: config('cache.default');
        $cacheStore = Cache::store($store);

        if (self::supportsTagging($cacheStore)) {
            try {
                $tagName = config('cache-control.tags.' . $tag, $tag);
                return $cacheStore->tags([$tagName])->flush();
            } catch (\Exception $e) {
                // Fall back to individual key clearing
                return self::clearTagKeys($tag, $store);
            }
        }

        // For stores without tagging support, clear individual keys
        return self::clearTagKeys($tag, $store);
    }

    /**
     * Clear all application caches
     */
    public static function clearAll(): void
    {
        // Clear tagged caches
        $tags = config('cache-control.tags', []);
        foreach ($tags as $tag) {
            self::clearTag($tag);
        }

        // Clear entire cache stores
        $stores = config('cache-control.stores', []);
        foreach (array_unique($stores) as $store) {
            if ($store !== 'default') {
                Cache::store($store)->flush();
            }
        }

        // Clear default store
        Cache::flush();
        
        Log::info('All application caches cleared');
    }

    /**
     * Build cache key with prefix
     */
    protected static function buildKey(string $key, ?string $tag = null): string
    {
        $prefix = config('cache-control.prefix', 'nahlabio');
        return $prefix . ':' . $key;
    }

    /**
     * Check if cache store supports tagging
     */
    protected static function supportsTagging($cacheStore): bool
    {
        // Check if it's a Redis or Memcached store (supports tagging)
        $supportedStores = [
            'Illuminate\Cache\RedisStore',
            'Illuminate\Cache\MemcachedStore',
        ];

        foreach ($supportedStores as $storeClass) {
            if ($cacheStore instanceof $storeClass) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add cache key to tag mapping for stores without tagging support
     */
    protected static function addKeyToTag(string $key, string $tag): void
    {
        $tagKey = self::buildKey("tags:{$tag}");
        $keys = Cache::get($tagKey, []);
        
        if (!in_array($key, $keys)) {
            $keys[] = $key;
            Cache::put($tagKey, $keys, config('cache-control.ttl.components.static', 3600));
        }
    }

    /**
     * Clear cache keys by tag for stores without tagging support
     */
    protected static function clearTagKeys(string $tag, string $store): bool
    {
        $tagKey = self::buildKey("tags:{$tag}");
        $keys = Cache::store($store)->get($tagKey, []);
        
        foreach ($keys as $key) {
            Cache::store($store)->forget($key);
        }
        
        // Clear the tag mapping itself
        Cache::store($store)->forget($tagKey);
        
        return true;
    }

    /**
     * Log cache performance if monitoring is enabled
     */
    protected static function logPerformance(string $key, bool $hit, float $duration): void
    {
        if (!config('cache-control.monitoring.enabled', false)) {
            return;
        }

        $logHits = config('cache-control.monitoring.log_hits', false);
        $logMisses = config('cache-control.monitoring.log_misses', false);

        if ($hit && $logHits) {
            Log::debug('Cache HIT', [
                'key' => $key,
                'duration' => round($duration * 1000, 2) . 'ms'
            ]);
        } elseif (!$hit && $logMisses) {
            Log::debug('Cache MISS', [
                'key' => $key,
                'duration' => round($duration * 1000, 2) . 'ms'
            ]);
        }
    }

    /**
     * Get cache statistics
     */
    public static function getStats(): array
    {
        if (!self::isEnabled()) {
            return ['enabled' => false];
        }

        return [
            'enabled' => true,
            'stores' => config('cache-control.stores'),
            'ttl_settings' => config('cache-control.ttl'),
            'monitoring' => config('cache-control.monitoring'),
        ];
    }

    /**
     * Helper methods for specific cache types
     */
    
    public static function rememberProducts(string $key, \Closure $callback, ?int $ttl = null)
    {
        $ttl = $ttl ?: config('cache-control.ttl.products.list', 3600);
        $store = config('cache-control.stores.products') ?: config('cache.default');
        return self::remember($key, $ttl, $callback, 'products', $store);
    }

    public static function rememberReviews(string $key, \Closure $callback, ?int $ttl = null)
    {
        $ttl = $ttl ?: config('cache-control.ttl.reviews.list', 3600);
        $store = config('cache-control.stores.reviews') ?: config('cache.default');
        return self::remember($key, $ttl, $callback, 'reviews', $store);
    }

    public static function rememberNavigation(string $key, \Closure $callback, ?int $ttl = null)
    {
        $ttl = $ttl ?: config('cache-control.ttl.navigation.header', 900);
        $store = config('cache-control.stores.navigation') ?: config('cache.default');
        return self::remember($key, $ttl, $callback, 'navigation', $store);
    }

    public static function rememberComponent(string $key, \Closure $callback, ?int $ttl = null)
    {
        $ttl = $ttl ?: config('cache-control.ttl.components.default', 900);
        $store = config('cache-control.stores.components') ?: config('cache.default');
        return self::remember($key, $ttl, $callback, 'components', $store);
    }

    public static function rememberView(string $key, \Closure $callback, ?int $ttl = null)
    {
        $ttl = $ttl ?: config('cache-control.ttl.views.default', 1800);
        $store = config('cache-control.stores.views') ?: config('cache.default');
        return self::remember($key, $ttl, $callback, 'static', $store);
    }
}