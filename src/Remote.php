<?php

namespace Nulvem\Remote;

use Nulvem\Remote\Connections\Sftp;
use Nulvem\Remote\Connections\Ssh;

class Remote
{
    public function sftp(
        string $host,
    ): Sftp
    {
        return new Sftp(
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
