<?php

namespace Nulvem\Remote\Clients\Outputs;

class SftpOutput
{
    public function __construct(
        private readonly bool $output,
    )
    {
    }

    public function success(): bool
    {
        return $this->output;
    }

    public function failed(): bool
    {
        return !$this->success();
    }
}
