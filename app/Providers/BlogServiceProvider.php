<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('Blog\Config', function ($app) {
            return new \App\Services\Blog\ConfigService();
        });
        $this->app->extend('Blog\Config', function ($newInstance) {
            return new \App\Services\Blog\Cache\CacheService($newInstance);
        });



        $this->app->singleton('Blog\Post', function ($app) {
            return new \App\Services\Blog\PostService();
        });
        $this->app->extend('Blog\Post', function ($newInstance) {
            return new \App\Services\Blog\Cache\CacheService($newInstance);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
