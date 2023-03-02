<?php

namespace Nulvem\Remote\Client;

use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\RSA;
use phpseclib3\Net\SSH2;

class Connection
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
            Log::channel($channel)->info("Output from ip: $this->server\n\n$output");
        }

        return new SshOutput(
            output: $output
        );
    }

    private function keyContent(): string
    {
        return file_get_contents(config('remote.auth.key_path'));
    }
}
