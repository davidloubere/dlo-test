<?php

declare(strict_types=1);

namespace DavidLoubere\Test;

require 'MemoryTracker.php';
require 'TimeTracker.php';

use Generator;

class Matrix
{
    /** int $dimension */
    private $dimension;

    public function __construct(int $dimension)
    {
        $this->dimension = $dimension;
    }

    public function test(): void
    {
        $tracer = new TimeTracker();
        $this->iterate($this->buildArray());
        $tracer->measure('array');

        echo "\n";

        $tracer = new TimeTracker();
        $this->iterate($this->buildYield());
        $tracer->measure('yield');
    }

    private function buildArray(): array
    {
        $matrix = [];

        for ($row = 1; $row <= $this->dimension; $row++) {
            for ($column = 1; $column <= $this->dimension; $column++) {
                $matrix[$row][$column] = $this->computeValue($row, $column);
            }
        }

        return $matrix;
    }

    private function buildYield(): Generator
    {
        for ($row = 1; $row <= $this->dimension; $row++) {
            for ($column = 1; $column <= $this->dimension; $column++) {
                yield $row => [$column => $this->computeValue($row, $column)];
            }
        }
    }

    private function computeValue(int $row, int $column): int
    {
        return $row * $column;
    }

    private function iterate(iterable $matrice): void
    {
        $memoryTracker = new MemoryTracker();

        foreach ($matrice as $line => $valuesByLine) {
            foreach ($valuesByLine as $column => $value) {
                if (0 === $line % ($this->dimension / 10) && 0 === $column % ($this->dimension / 10)) {
                    $memoryTracker->measure("$line, $column");
                }
            }
        }
    }
}