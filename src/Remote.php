<?php

namespace Nulvem\Remote;

use Nulvem\Remote\Clients\Scp;
use Nulvem\Remote\Clients\Ssh;

class Remote
{
    public function scp(): Scp
    {
        return new Scp();
    }

    public function ssh(): Ssh
    {
        return new Ssh();
    }
}