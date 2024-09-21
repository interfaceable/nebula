<?php

declare(strict_types=1);

namespace Nebula\Facades;

use Illuminate\Support\Facades\Facade;

class Nebula extends Facade
{
    /**
     * {@inheritDoc}
     */
    public static function getFacadeAccessor(): string
    {
        return \Nebula\Nebula::class;
    }
}
