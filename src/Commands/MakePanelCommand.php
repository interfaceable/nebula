<?php

declare(strict_types=1);

namespace Nebula\Commands;

use Illuminate\Foundation\Console\ProviderMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:nebula-panel')]
class MakePanelCommand extends ProviderMakeCommand
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

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        $this
            ->replaceIn(
                stub: $stub,
                search: '{{ id }}',
                replaceWith: Str::kebab(Str::lower(Str::replace('PanelServiceProvider', '', $this->getNameInput())))
            )
            ->replaceIn(
                stub: $stub,
                search: '{{ prefix }}',
                replaceWith: Str::kebab(Str::lower(Str::replace('PanelServiceProvider', '', $this->getNameInput())))
            );

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/panel-service-provider.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Providers\Nebula';
    }

    /**
     * Get the desired class name from the input.
     */
    protected function getNameInput(): string
    {
        $name = parent::getNameInput();

        if (!Str::contains($name, 'Panel')) {
            $name .= 'Panel';
        }

        return $name.'ServiceProvider';
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => [
                'What should the Nebula panel be named?',
                'E.g. AdminPanel',
            ],
        ];
    }
}
