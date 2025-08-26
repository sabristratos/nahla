<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupProductImages extends Command
{
    protected $signature = 'nahla:setup-images';
    
    protected $description = 'Copy nahla-images from public to storage for proper asset handling';

    public function handle(): int
    {
        $publicPath = public_path('nahla-images');
        $storagePath = storage_path('app/public/nahla-images');

        if (!File::exists($publicPath)) {
            $this->warn('Source directory does not exist: ' . $publicPath);
            return self::FAILURE;
        }

        if (File::exists($storagePath)) {
            $this->info('Storage directory already exists, removing old version...');
            File::deleteDirectory($storagePath);
        }

        try {
            File::copyDirectory($publicPath, $storagePath);
            $this->info('Successfully copied nahla-images to storage directory');
            
            // Create storage link if it doesn't exist
            if (!File::exists(public_path('storage'))) {
                $this->call('storage:link');
            }
            
            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Failed to copy images: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}