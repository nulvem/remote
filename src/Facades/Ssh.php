<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Nulvem\Remote\Connections\Ssh on(string $host)
 * @method static \Nulvem\Remote\Connections\Ssh setTimeout(int $timeout)
 * @method static \Nulvem\Remote\Clients\Outputs\SshOutput run(string $script, array $data = [])
 */
class Ssh extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Connections\Ssh::class;
    }
}
