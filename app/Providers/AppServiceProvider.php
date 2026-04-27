<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\KeterlambatanService;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Mendaftarkan KeterlambatanService
        $this->app->singleton(KeterlambatanService::class, function ($app) {
            return new KeterlambatanService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
