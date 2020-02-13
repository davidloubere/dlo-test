<?php

declare(strict_types=1);

namespace DavidLoubere\Test;

class TimeTracker
{
    /** @var float */
    private $startTime;

    public function __construct()
    {
        $this->startTime = $this->getMicrotimeAsFloat();
    }

    public function measure(string $marker): void
    {
        $elapsedTime = $this->getMicrotimeAsFloat() - $this->startTime;

        echo sprintf(
            "[$marker]: %f s",
            $elapsedTime
        )."\n";
    }

    private function getMicrotimeAsFloat(): float
    {
        list($usec, $sec) = explode(" ", microtime());

        return ((float) $usec + (float) $sec);
    }
}
