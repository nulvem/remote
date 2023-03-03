<?php

namespace Nulvem\Remote\Clients;

use Illuminate\Support\Facades\Log;
use Nulvem\Remote\Clients\Outputs\SshOutput;
use phpseclib3\Crypt\RSA;
use phpseclib3\Net\SSH2;

class SshClient extends Client
{
    public function __construct(
        private string $server,
        private ?SSH2  $ssh = null,
    )
    {
        $this->ssh = new SSH2($this->server);

        $key = RSA::load($this->keyContent());

        $this->ssh->login(config('remote.auth.username'), $key);

        $this->ssh->setTimeout(0);
    }

    public function exec(
        string $script,
    ): SshOutput
    {
        $output = $this->ssh->exec($script);

        if ($channel = config('remote.log_channel')) {
            Log::channel($channel)->info("Output from server: $this->server\n\n$output");
        }

        return new SshOutput(
            output: $output
        );
    }
}
