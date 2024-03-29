<?php
declare(strict_types=1);

namespace App\Common;

final class PercentValue extends IntValue
{

    public function __construct(int $value)
    {
        if ($value < 0 || $value > 100) {
            throw new \InvalidArgumentException('Percent value must be between 0 and 100');
        }

        parent::__construct($value);
    }

    public static function new(int $int): static
    {
        return new self($int);
    }

    public function getFloatValue(): float
    {
        return $this->value / 100;
    }

    public function __toString(): string
    {
        return $this->value . '%';
    }
}