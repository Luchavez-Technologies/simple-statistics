<?php

namespace Luchavez\SimpleStatistics;

use Luchavez\SimpleStatistics\Models\Statistics;
use Luchavez\SimpleStatistics\Observers\StatisticsObserver;
use Luchavez\SimpleStatistics\Policies\StatisticsPolicy;
use Luchavez\SimpleStatistics\Repositories\StatisticsRepository;
use Luchavez\StarterKit\Abstracts\BaseStarterKitServiceProvider;

class SimpleStatisticsServiceProvider extends BaseStarterKitServiceProvider
{
    protected array $morph_map = [
        'statistics' => Statistics::class,
    ];

    protected array $observer_map = [
        StatisticsObserver::class => Statistics::class,
    ];

    protected array $policy_map = [
        StatisticsPolicy::class => Statistics::class,
    ];

    protected array $repository_map = [
        StatisticsRepository::class => Statistics::class,
    ];

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register the service the package provides.
        $this->app->singleton('simple-statistics', function ($app) {
            return new SimpleStatistics();
        });

        parent::register();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
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
    }
}
