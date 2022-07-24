<?php

namespace App\Providers;

use App\Services\RemoteApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RemoteApiService::class, function ($app) {
            return new RemoteApiService(config('app.skeleton_api_base_url'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
