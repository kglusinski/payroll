<?php
declare(strict_types=1);

namespace App\Common\Infra\Doctrine\Type;

use App\Common\PercentValue;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class PercentType extends IntegerType
{
    const NAME = 'percent';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?int
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof PercentValue) {
            return $value->value;
        }

        return null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?PercentValue
    {
        return $value === null ? null : PercentValue::new($value);
    }
}