<?php

namespace Nulvem\Remote\Clients;

use Nulvem\Remote\Clients\Outputs\SftpOutput;
use phpseclib3\Crypt\RSA;
use phpseclib3\Net\SFTP;

class SftpClient extends Client
{
    public function __construct(
        private string $host,
        private int    $port = 22,
        private int    $timeout = 0,
        private bool   $preserveDates = true,
        private ?SFTP  $sftp = null,
    )
    {
        $this->sftp = new SFTP(
            host: $this->host,
            port: $this->port,
            timeout: $this->timeout
        );

        $this->preserveDates ?
            $this->sftp->enableDatePreservation() :
            $this->sftp->disableDatePreservation();

        $key = RSA::load($this->keyContent());

        $this->sftp->login(config('remote.auth.username'), $key);
    }

    public function get(
        string $from,
        string $to = null,
    ): SftpOutput
    {
        $output = $this->sftp->get($from, $to);

        return new SftpOutput(
            output: $output
        );
    }

    public function put(
        string $from,
        string $to = '/root',
    ): SftpOutput
    {
        $fileName = basename($from);

        $output = $this->sftp->put("$to/$fileName", $from, SFTP::SOURCE_LOCAL_FILE);

        return new SftpOutput(
            output: $output
        );
    }
}
