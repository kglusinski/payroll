<?php
declare(strict_types=1);

namespace App\Department\Domain;

final class PercentValue
{
    public readonly int $value;

    public function __construct(int $value)
    {
        if ($value < 0 || $value > 100) {
            throw new \InvalidArgumentException('Percent value must be between 0 and 100');
        }

        $this->value = $value;
    }
}