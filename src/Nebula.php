<?php

declare(strict_types=1);

namespace Nebula;

/**
 * @template T of Panel
 */
class Nebula
{
    /**
     * Registered panels within the application.
     *
     * @var array<int, T>
     */
    protected array $panels = [];

    /**
     * Register a new panel.
     */
    public function registerPanel(Panel $panel): void
    {
        $this->panels[] = $panel;
    }

    /**
     * Get all registered panels.
     *
     * @return array<int, T>
     */
    public function getPanels(): array
    {
        return $this->panels;
    }
}
