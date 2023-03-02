<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nulvem\Remote\Clients\Scp
 */
class Scp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Clients\Scp::class;
    }
}