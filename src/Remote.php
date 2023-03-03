<?php

namespace Nulvem\Remote;

use Nulvem\Remote\Connections\Scp;
use Nulvem\Remote\Connections\Ssh;

class Remote
{
    public function scp(
        string $host,
    ): Scp
    {
        return new Scp(
            host: $host
        );
    }

    public function ssh(
        string $host,
    ): Ssh
    {
        return new Ssh(
            host: $host
        );
    }
}
