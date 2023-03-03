<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Nulvem\Remote\Connections\Sftp sftp(string $host)
 * @method static \Nulvem\Remote\Connections\Ssh ssh(string $host)
 */
class Remote extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Remote::class;
    }
}
