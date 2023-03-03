<?php

namespace Nulvem\Remote\Connections;

use Nulvem\Remote\Clients\SshClient;
use Nulvem\Remote\Clients\Outputs\SshOutput;

class Ssh
{
    public function __construct(
        private ?string $host = null,
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
        string $host,
    ): static
    {
        $this->host = $host;

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
            host: $this->host
        ));

        return $client->exec(
            script: $script
        );
    }
}
