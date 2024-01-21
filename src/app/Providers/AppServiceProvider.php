<?php

namespace App\Providers;

use App\Interfaces\ImportInterface;
use App\Service\Product\ServiceImport;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImportInterface::class, ServiceImport::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
