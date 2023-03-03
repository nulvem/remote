<?php

namespace Nulvem\Remote\Clients;

use Illuminate\Support\Facades\Log;
use Nulvem\Remote\Clients\Outputs\SshOutput;
use phpseclib3\Crypt\RSA;
use phpseclib3\Net\SSH2;

class SshClient extends Client
{
    public function __construct(
        private string $host,
        private int    $port = 22,
        private int    $timeout = 0,
        private ?SSH2  $ssh = null,
    )
    {
        $this->ssh = new SSH2(
            host: $this->host,
            port: $this->port,
            timeout: $this->timeout
        );

        $key = RSA::load($this->keyContent());

        $this->ssh->login(config('remote.auth.username'), $key);
    }

    public function exec(
        string $script,
    ): SshOutput
    {
        $output = $this->ssh->exec($script);

        if ($channel = config('remote.log_channel')) {
            Log::channel($channel)->info("Output from host: $this->host\n\n$output");
        }

        return new SshOutput(
            output: $output
        );
    }
}
