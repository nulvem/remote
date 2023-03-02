<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nulvem\Remote\Clients\Ssh
 */
class Ssh extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Connections\Ssh::class;
    }
}
