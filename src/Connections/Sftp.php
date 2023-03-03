<?php

namespace Nulvem\Remote\Connections;

use Nulvem\Remote\Clients\Outputs\SftpOutput;
use Nulvem\Remote\Clients\SftpClient;

class Sftp extends Connection
{
    public function __construct(
        private ?string     $host = null,
        private bool        $preserveDates = true,
        private ?SftpClient $client = null,
    )
    {
        $this->client = new SftpClient(
            host: $this->host,
            preserveDates: $this->preserveDates
        );
    }

    public function preserveDates(
        bool $preserveDates = true,
    ): static
    {
        $this->preserveDates = $preserveDates;

        return $this;
    }

    public function get(
        string $from,
        string $to = null,
    ): SftpOutput
    {
        return $this->client->get(
            from: $from,
            to: $to
        );
    }

    public function put(
        string $from,
        string $to = '/root',
    ): SftpOutput
    {
        return $this->client->put(
            from: $from,
            to: $to
        );
    }
}
