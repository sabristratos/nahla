<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Cache Control
    |--------------------------------------------------------------------------
    |
    | This configuration allows you to globally enable or disable caching
    | throughout the application. When disabled, all cache operations
    | will be bypassed, useful for debugging and development.
    |
    */

    'enabled' => env('CACHE_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cache TTL (Time To Live) Settings
    |--------------------------------------------------------------------------
    |
    | Define different cache durations for various types of data.
    | Values are in seconds.
    |
    */

    'ttl' => [
        'products' => [
            'list' => env('CACHE_PRODUCTS_LIST_TTL', 3600), // 1 hour
            'featured' => env('CACHE_PRODUCTS_FEATURED_TTL', 1800), // 30 minutes
            'single' => env('CACHE_PRODUCT_SINGLE_TTL', 7200), // 2 hours
            'price_stats' => env('CACHE_PRICE_STATS_TTL', 3600), // 1 hour
        ],
        'reviews' => [
            'featured' => env('CACHE_REVIEWS_FEATURED_TTL', 1800), // 30 minutes
            'list' => env('CACHE_REVIEWS_LIST_TTL', 3600), // 1 hour
        ],
        'navigation' => [
            'header' => env('CACHE_HEADER_TTL', 900), // 15 minutes
            'menu' => env('CACHE_MENU_TTL', 1800), // 30 minutes
        ],
        'pages' => [
            'home' => env('CACHE_HOME_TTL', 1800), // 30 minutes
            'product_index' => env('CACHE_PRODUCT_INDEX_TTL', 900), // 15 minutes
        ],
        'components' => [
            'default' => env('CACHE_COMPONENT_TTL', 900), // 15 minutes
            'static' => env('CACHE_STATIC_COMPONENT_TTL', 3600), // 1 hour
        ],
        'views' => [
            'default' => env('CACHE_VIEW_TTL', 1800), // 30 minutes
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Tags
    |--------------------------------------------------------------------------
    |
    | Define cache tags for organized cache invalidation.
    | Tags allow you to group related cache entries together.
    |
    */

    'tags' => [
        'products' => 'products',
        'reviews' => 'reviews', 
        'navigation' => 'navigation',
        'home' => 'home',
        'components' => 'components',
        'static' => 'static',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Keys Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix for cache keys to avoid conflicts and organize cache entries.
    |
    */

    'prefix' => env('CACHE_KEY_PREFIX', 'nahlabio'),

    /*
    |--------------------------------------------------------------------------
    | Performance Monitoring
    |--------------------------------------------------------------------------
    |
    | Enable cache performance monitoring and logging.
    |
    */

    'monitoring' => [
        'enabled' => env('CACHE_MONITORING_ENABLED', false),
        'log_hits' => env('CACHE_LOG_HITS', false),
        'log_misses' => env('CACHE_LOG_MISSES', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Stores for Different Data Types
    |--------------------------------------------------------------------------
    |
    | Specify which cache store to use for different types of data.
    | This allows for optimized caching strategies.
    | Uses Laravel's configured default cache store if not specified.
    |
    */

    'stores' => [
        'products' => env('CACHE_PRODUCTS_STORE', null),
        'reviews' => env('CACHE_REVIEWS_STORE', null),
        'navigation' => env('CACHE_NAVIGATION_STORE', null),
        'views' => env('CACHE_VIEWS_STORE', null),
        'components' => env('CACHE_COMPONENTS_STORE', null),
    ],

];