<?php
declare(strict_types=1);

namespace App\Common\Infra\Doctrine\Type;

use App\Common\IntValue;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class SpecialIntegerType extends IntegerType
{
    const NAME = 'specialInt';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?int
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof IntValue) {
            return $value->value;
        }

        return null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?IntValue
    {
        return $value === null ? null : IntValue::new($value);
    }
}