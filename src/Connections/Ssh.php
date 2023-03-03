<?php

namespace Nulvem\Remote\Connections;

use Nulvem\Remote\Clients\SshClient;
use Nulvem\Remote\Clients\Outputs\SshOutput;

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
        $this->server = $server;

        return $this;
    }

    public function run(
        string $script,
        array  $data = [],
    ): SshOutput
    {
        $script = $this->compileScript(
            script: $script,
            data: $data
        );

        $client = (new SshClient(
            server: $this->server
        ));

        return $client->exec(
            script: $script
        );
    }
}
