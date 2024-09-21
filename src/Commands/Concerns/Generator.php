<?php

declare(strict_types=1);

namespace Nebula\Commands\Concerns;

trait Generator
{
    /**
     * Replace the given string in the given file.
     */
    public function replaceIn(string &$stub, string $search, string $replaceWith): self
    {
        $stub = str_replace($search, $replaceWith, $stub);

        return $this;
    }
}
