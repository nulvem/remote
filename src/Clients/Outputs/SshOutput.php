<?php

namespace Nulvem\Remote\Clients\Outputs;

class SshOutput
{
    public function __construct(
        private readonly string $output,
    )
    {
    }

    public function output(): string
    {
        return $this->output;
    }

    public function success(): bool
    {
        $pattern = "/Remote script '(.*)' finished/m";

        return preg_match($pattern, $this->output) > 0;
    }

    public function failed(): bool
    {
        return !$this->success();
    }
}
