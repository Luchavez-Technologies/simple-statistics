<?php

namespace Luchtech\SimpleStatistics;

use Illuminate\Support\ServiceProvider;

class SimpleStatisticsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'luchtech');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'luchtech');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/simple-statistics.php', 'simple-statistics');

        // Register the service the package provides.
        $this->app->singleton('simple-statistics', function ($app) {
            return new SimpleStatistics;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['simple-statistics'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/simple-statistics.php' => config_path('simple-statistics.php'),
        ], 'simple-statistics.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/luchtech'),
        ], 'simple-statistics.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/luchtech'),
        ], 'simple-statistics.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/luchtech'),
        ], 'simple-statistics.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
