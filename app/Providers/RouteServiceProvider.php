<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        // $this->routes(
        //     function () {
        //         Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));
        //         Route::middleware('web')->group(base_path('routes/web.php'));
        //     }
        // );
    }
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60)->by(optional($request->user)->id ?: $request->ip());
        });
        RateLimiter::for('reviews', function ($request) {
            return Limit::perMinute(2)->by(optional($request->user)->id ?: $request->ip());
        });
    }
}
