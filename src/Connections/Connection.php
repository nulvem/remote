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
}
