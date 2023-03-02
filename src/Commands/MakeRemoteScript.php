<?php

namespace Nulvem\Remote\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MakeRemoteScript extends GeneratorCommand
{
    protected $name = 'make:remote-script';

    protected $description = 'Create a new remote script';

    protected $type = 'remote script';

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the script'],
        ];
    }

    protected function getDefaultNamespace(
        $rootNamespace
    ): string
    {
        return $rootNamespace.'\Scripts';
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'.blade.php';
    }

    protected function getStub(): string
    {
        $customStub = $this->laravel->basePath('stubs/nulvem/remote-script.stub');

        if (file_exists($customStub)) {
            return $customStub;
        }

        return __DIR__ . '/../../stubs/remote-script.stub';
    }

    protected function replaceClass(
        $stub,
        $name
    ): array|string
    {
        $scriptName = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace('{{script_name}}', $scriptName, $stub);
    }
}
