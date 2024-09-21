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
     * Add a new panel.
     */
    public function addPanel(Panel $panel): void
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
