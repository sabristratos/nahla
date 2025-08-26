<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CacheToggleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:toggle 
                            {--enable : Enable caching globally}
                            {--disable : Disable caching globally}
                            {--status : Show current cache status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toggle application caching on/off globally';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('status')) {
            $this->showStatus();
            return 0;
        }

        if ($this->option('enable')) {
            $this->enableCache();
            return 0;
        }

        if ($this->option('disable')) {
            $this->disableCache();
            return 0;
        }

        // Interactive mode
        $this->interactiveToggle();
        return 0;
    }

    /**
     * Show current cache status
     */
    protected function showStatus(): void
    {
        $enabled = config('cache-control.enabled');
        $status = $enabled ? 'ENABLED' : 'DISABLED';
        $color = $enabled ? 'info' : 'error';
        
        $this->line("Cache Status: <{$color}>{$status}</{$color}>");
        $this->line("Default Store: " . config('cache.default'));
        
        if ($enabled) {
            $this->info('✓ Application caching is active');
        } else {
            $this->warn('⚠ Application caching is disabled - all cache operations will be bypassed');
        }
    }

    /**
     * Enable caching globally
     */
    protected function enableCache(): void
    {
        $this->updateEnvFile('CACHE_ENABLED', 'true');
        $this->info('✓ Application caching has been ENABLED');
        $this->line('All cache operations will now be active.');
    }

    /**
     * Disable caching globally
     */
    protected function disableCache(): void
    {
        $this->updateEnvFile('CACHE_ENABLED', 'false');
        $this->error('⚠ Application caching has been DISABLED');
        $this->line('All cache operations will be bypassed.');
        $this->line('Use --enable to re-enable caching.');
    }

    /**
     * Interactive cache toggle
     */
    protected function interactiveToggle(): void
    {
        $this->info('Cache Toggle Manager');
        $this->newLine();
        $this->showStatus();
        $this->newLine();

        $choice = $this->choice(
            'What would you like to do?',
            [
                'enable' => 'Enable caching',
                'disable' => 'Disable caching',
                'status' => 'Show status only',
                'exit' => 'Exit without changes'
            ],
            'status'
        );

        switch ($choice) {
            case 'enable':
                $this->enableCache();
                break;
            case 'disable':
                if ($this->confirm('Are you sure you want to disable all caching?')) {
                    $this->disableCache();
                }
                break;
            case 'status':
                // Already shown above
                break;
            case 'exit':
                $this->info('No changes made.');
                break;
        }
    }

    /**
     * Update environment file
     */
    protected function updateEnvFile(string $key, string $value): void
    {
        $envPath = base_path('.env');
        
        if (!File::exists($envPath)) {
            $this->error('.env file not found');
            return;
        }

        $envContent = File::get($envPath);
        
        // Check if key already exists
        if (preg_match("/^{$key}=/m", $envContent)) {
            // Update existing key
            $envContent = preg_replace(
                "/^{$key}=.*$/m",
                "{$key}={$value}",
                $envContent
            );
        } else {
            // Add new key
            $envContent .= "\n{$key}={$value}\n";
        }

        File::put($envPath, $envContent);
        
        // Clear config cache to reload
        $this->call('config:clear');
    }
}
