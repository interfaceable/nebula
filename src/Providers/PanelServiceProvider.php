<?php

declare(strict_types=1);

namespace Nebula\Providers;

use Illuminate\Support\ServiceProvider;
use Nebula\Facades\Nebula;
use Nebula\Panel;

abstract class PanelServiceProvider extends ServiceProvider
{
    /**
     * Register the Panel configuration.
     */
    abstract public function build(Panel $panel): Panel;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Nebula::addPanel($this->build(new Panel())->boot());
    }
}
