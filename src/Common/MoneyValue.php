<?php
declare(strict_types=1);

namespace App\Common;

final class MoneyValue
{
    public readonly int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Money value must be greater than 0');
        }

        $this->value = $value;
    }
}