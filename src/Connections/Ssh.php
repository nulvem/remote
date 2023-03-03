<?php

namespace Nulvem\Remote\Connections;

use Nulvem\Remote\Clients\SshClient;
use Nulvem\Remote\Clients\Outputs\SshOutput;

class Ssh extends Connection
{
    public function __construct(
        private ?string $host = null,
        private ?SshClient $client = null,
    )
    {
        $this->client = new SshClient(
            host: $this->host
        );
    }

    private function compileScript(
        string $script,
        array  $data = [],
    ): string
    {
        return view()->make($script, $data)->render();
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

        return $this->client->exec(
            script: $script
        );
    }
}
