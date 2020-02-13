<?php

namespace DavidLoubere\Test;

class MemoryTracker
{
    public function measure(string $marker): void
    {
        $used = memory_get_usage(false);
        $allocated = memory_get_usage(true);

        echo sprintf(
                "[$marker]: %d KB used, %d KB allocated",
                $used / 1024,
                $allocated / 1024
            ) . "\n";
    }
}