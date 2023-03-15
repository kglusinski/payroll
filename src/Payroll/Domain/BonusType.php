<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

enum BonusType: string
{
    case PERCENT = 'percentage';
    case FIXED = 'fixed';

    public static function fromString(string $value): self
    {
        return match ($value) {
            'percentage' => self::PERCENT,
            'fixed' => self::FIXED,
            default => throw new \InvalidArgumentException('Invalid bonus type'),
        };
    }

    public function toString(): string
    {
        return match ($this) {
            self::PERCENT => 'percentage',
            self::FIXED => 'fixed',
        };
    }
}
