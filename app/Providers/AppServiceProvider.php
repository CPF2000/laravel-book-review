<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

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
        // 设置时区
        date_default_timezone_set('Asia/Shanghai');
        // 设置 Carbon 本地化
        Carbon::setLocale('zh');
        // 或者使用 Laravel 的辅助函数
        config(['app.timezone' => 'Asia/Shanghai']);
    }
}
