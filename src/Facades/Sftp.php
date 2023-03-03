<?php

namespace Nulvem\Remote\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Nulvem\Remote\Connections\Sftp preserveDates(bool $preserveDates = true)
 * @method static \Nulvem\Remote\Connections\Sftp on(string $host)
 * @method static \Nulvem\Remote\Connections\Sftp setTimeout(int $timeout)
 * @method static \Nulvem\Remote\Clients\Outputs\SftpOutput get(string $from, string $to = null)
 * @method static \Nulvem\Remote\Clients\Outputs\SftpOutput put(string $from, string $to = '/root')
 */
class Sftp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nulvem\Remote\Connections\Sftp::class;
    }
}
