<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nulvem\Remote\Remote
 */
class Remote extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Remote::class;
    }
}