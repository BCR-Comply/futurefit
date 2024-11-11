<?php

namespace App\Providers;

use App\Models\Scheme;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        $schemes = Scheme::where('is_active', 1)->get();
        View::share('schemes', $schemes);

        View::share('APP_BASE_IMAGE_PATH', env('APP_BASE_IMAGE_PATH', 'futurefitapi'));
    }
}
