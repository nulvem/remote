<?php

namespace Nulvem\Remote\Connections;

use Nulvem\Remote\Client\Connection;

class Ssh
{
    public function __construct(
        private ?string $server = null,
    )
    {
    }

    private function compileScript(
        string $script,
        array  $data = [],
    ): string
    {
        return view()->make($script, $data)->render();
    }

    public function on(
        string $server,
    ): static
    {
        return $this;
    }

    public function run(
        string $script,
        array  $data = [],
    )
    {
        $script = $this->compileScript(
            script: $script,
            data: $data
        );

        $client = (new Connection(
            server: $this->server
        ));

        $client->exec(
            script: $script
        );
    }
}
