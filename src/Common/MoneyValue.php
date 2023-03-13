<?php
declare(strict_types=1);

namespace App\Common;

final class MoneyValue extends IntValue
{
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Money value must be greater than 0');
        }

        parent::__construct($value);
    }

    public static function new(int $int): static
    {
        return new self($int);
    }

    public function multiply(int|float $multiplier): self
    {
        return new self((int) ($this->value * $multiplier));
    }

    public function add(MoneyValue $bonusValue): self
    {
        return new self($this->value + $bonusValue->value);
    }
}