<?php
declare(strict_types=1);

namespace App\Common;

abstract class IntValue
{
    public readonly int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }
}