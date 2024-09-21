<?php

declare(strict_types=1);

namespace Nebula\Providers;

use Nebula\Nebula;
use Nebula\Commands;
use Illuminate\Support\ServiceProvider;

class NebulaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'nebula');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakePanelCommand::class,
            ]);
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Nebula::class, fn () => new Nebula());
    }
}
