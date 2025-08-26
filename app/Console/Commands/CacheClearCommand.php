<?php

namespace App\Console\Commands;

use App\Services\CacheService;
use Illuminate\Console\Command;

class CacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-app 
                            {--tag= : Clear cache by specific tag}
                            {--all : Clear all application caches}
                            {--stats : Show cache statistics}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application caches with granular control';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!CacheService::isEnabled()) {
            $this->warn('Cache is globally disabled. No caches to clear.');
            return 0;
        }

        if ($this->option('stats')) {
            $this->showCacheStats();
            return 0;
        }

        if ($this->option('all')) {
            $this->clearAllCaches();
            return 0;
        }

        if ($tag = $this->option('tag')) {
            $this->clearTaggedCache($tag);
            return 0;
        }

        // Interactive mode
        $this->interactiveClear();
        return 0;
    }

    /**
     * Show cache statistics
     */
    protected function showCacheStats(): void
    {
        $stats = CacheService::getStats();
        
        $this->info('Cache Configuration:');
        $this->table(['Setting', 'Value'], [
            ['Enabled', $stats['enabled'] ? 'Yes' : 'No'],
            ['Default Store', config('cache.default')],
            ['Monitoring', $stats['monitoring']['enabled'] ? 'Enabled' : 'Disabled'],
        ]);

        if ($stats['enabled']) {
            $this->info('TTL Settings:');
            foreach ($stats['ttl_settings'] as $category => $settings) {
                $this->line("  <comment>{$category}:</comment>");
                foreach ($settings as $key => $ttl) {
                    $this->line("    {$key}: {$ttl}s");
                }
            }
        }
    }

    /**
     * Clear all application caches
     */
    protected function clearAllCaches(): void
    {
        $this->info('Clearing all application caches...');
        
        $this->withProgressBar(['products', 'reviews', 'navigation', 'home', 'components', 'static'], function ($tag) {
            CacheService::clearTag($tag);
        });
        
        $this->newLine();
        CacheService::clearAll();
        
        $this->info('✓ All application caches cleared successfully!');
    }

    /**
     * Clear cache by specific tag
     */
    protected function clearTaggedCache(string $tag): void
    {
        $availableTags = config('cache-control.tags', []);
        
        if (!in_array($tag, $availableTags) && !array_key_exists($tag, $availableTags)) {
            $this->error("Unknown cache tag: {$tag}");
            $this->info('Available tags: ' . implode(', ', array_keys($availableTags)));
            return;
        }

        $this->info("Clearing cache for tag: {$tag}");
        CacheService::clearTag($tag);
        $this->info("✓ Cache cleared for tag: {$tag}");
    }

    /**
     * Interactive cache clearing
     */
    protected function interactiveClear(): void
    {
        $this->info('Application Cache Manager');
        $this->newLine();

        $choice = $this->choice(
            'What would you like to do?',
            [
                'clear-all' => 'Clear all caches',
                'clear-products' => 'Clear product caches',
                'clear-reviews' => 'Clear review caches', 
                'clear-navigation' => 'Clear navigation caches',
                'clear-components' => 'Clear component caches',
                'stats' => 'Show cache statistics',
                'exit' => 'Exit'
            ],
            'stats'
        );

        switch ($choice) {
            case 'clear-all':
                $this->clearAllCaches();
                break;
            case 'clear-products':
                $this->clearTaggedCache('products');
                break;
            case 'clear-reviews':
                $this->clearTaggedCache('reviews');
                break;
            case 'clear-navigation':
                $this->clearTaggedCache('navigation');
                break;
            case 'clear-components':
                $this->clearTaggedCache('components');
                break;
            case 'stats':
                $this->showCacheStats();
                break;
            case 'exit':
                $this->info('Goodbye!');
                break;
        }
    }
}
