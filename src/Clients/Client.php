<?php

namespace Nulvem\Remote\Clients;

class Client
{
    protected function keyContent(): string
    {
        return file_get_contents(config('remote.auth.key_path'));
    }
}
