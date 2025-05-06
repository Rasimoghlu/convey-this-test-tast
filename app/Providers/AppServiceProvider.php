<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Disable Vite manifest check during development
        Vite::useCspNonce();
        Vite::useManifestFilename(null);
        
        // Use Bootstrap for pagination
        Paginator::useBootstrap();
    }
}
