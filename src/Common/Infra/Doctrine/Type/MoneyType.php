<?php
declare(strict_types=1);

namespace App\Common\Infra\Doctrine\Type;

use App\Common\MoneyValue;
use App\Common\PercentValue;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class MoneyType extends IntegerType
{
    const NAME = 'money';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?int
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof MoneyValue || $value instanceof PercentValue) {
            return $value->value;
        }

        return null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?MoneyValue
    {
        return $value === null ? null : MoneyValue::new($value);
    }
}