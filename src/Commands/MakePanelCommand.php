<?php

declare(strict_types=1);

namespace Nebula\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:nebula-panel')]
class MakePanelCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:nebula-panel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Nebula admin panel';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Nebula panel';

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
