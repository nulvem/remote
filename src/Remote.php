<?php

namespace Nulvem\Remote;

use Nulvem\Remote\Connections\Scp;
use Nulvem\Remote\Connections\Ssh;

class Remote
{
    public function scp(
        string $server,
    ): Scp
    {
        return new Scp(
            server: $server
        );
    }

    public function ssh(
        string $server,
    ): Ssh
    {
        return new Ssh(
            server: $server
        );
    }
}
