<?php

namespace Wink;

use Illuminate\Support\Facades\Route;
use Wink\Http\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;

class WinkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerPublishing();

        $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'wink'
        );
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {

        $path = config('wink.path');
        $middlewareGroup = ["web", "auth:admin", "auth", Authenticate::class];
        Route::namespace('Wink\Http\Controllers')
            ->middleware($middlewareGroup)
            ->as('wink.')
            ->prefix($path)
            ->group(function () {
                $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
            });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/wink'),
            ], 'wink-assets');

            $this->publishes([
                __DIR__.'/../config/wink.php' => config_path('wink.php'),
            ], 'wink-config');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/wink.php', 'wink'
        );

        $this->commands([
            Console\InstallCommand::class,
            Console\MigrateCommand::class,
        ]);
    }
}
