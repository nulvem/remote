<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nulvem\Remote\Clients\Sftp
 */
class Sftp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Connections\Sftp::class;
    }
}
