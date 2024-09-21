<?php

declare(strict_types=1);

namespace Nebula;

use Illuminate\Support\Facades\Route;
use Nebula\Http\Controllers\Auth\AuthenticatedSessionController;
use Nebula\Http\Middleware\Authenticate;

class Panel
{
    /**
     * Indicates if the panel has been booted.
     */
    protected bool $booted = false;

    /**
     * The unique identifier of the panel.
     */
    protected string $id;

    /**
     * Url path for the panel.
     */
    protected string $path;

    /**
     * Resources that belong to the panel.
     */
    protected array $resources = [];

    /**
     * Middlewares that are applied to the panel.
     */
    protected array $middleware = [];

    /**
     * Middlewares that are applied as auth middleware to the panel.
     */
    protected array $authMiddleware = [];

    /**
     * Add the ID for the panel.
     */
    public function id(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the path of the panel.
     */
    public function path(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Register the login routes.
     *
     * @param  callable|null  $addLoginPageUsing  (Panel $panel)|null  $addLoginPageUsing
     * @return Panel
     */
    public function addLoginPage(?callable $addLoginPageUsing = null): self
    {
        if ($addLoginPageUsing) {
            call_user_func($addLoginPageUsing, $this);

            return $this;
        }

        Route::middleware(['web', 'guest'])
            ->prefix($this->path)
            ->get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('nebula.'.$this->id.'.login');

        Authenticate::redirectUsing(fn ($request) => route('nebula.'.$this->id.'.login'));

        return $this;
    }

    /**
     * Set the auth middleware for the panel.
     */
    public function withAuthMiddleware(array $authMiddleware): self
    {
        $this->authMiddleware = $authMiddleware;

        return $this;
    }

    /**
     * Add middlewares to the panel.
     */
    public function withMiddleware(array $middleware): self
    {
        $this->middleware = $middleware;

        return $this;
    }

    /**
     * Boot the panel.
     */
    public function boot(): self
    {
        if ($this->booted) {
            return $this;
        }

        $this->registerRoutes();

        $this->booted = true;

        return $this;
    }

    /**
     * Register the panel routes.
     */
    protected function registerRoutes(): void
    {
        $middleware = array_merge($this->middleware, $this->authMiddleware);

        Route::prefix($this->path)
            ->middleware($middleware)
            ->group(function () {
                Route::get('/', function () {
                    return 'Hello, From Nebula Admin!';
                });
            });
    }
}
