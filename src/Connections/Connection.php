<?php

namespace Nulvem\Remote\Connections;

class Connection
{
    public function on(
        string $host,
    ): static
    {
        $this->host = $host;

        return $this;
    }

    public function setTimeout(
        int $timeout,
    ): static
    {
        $this->timeout = $timeout;

        return $this;
    }
}
