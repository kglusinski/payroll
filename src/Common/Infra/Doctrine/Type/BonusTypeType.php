<?php
declare(strict_types=1);

namespace App\Common\Infra\Doctrine\Type;

use App\Common\Identity;
use App\Department\Domain\BonusType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BonusTypeType extends StringType
{
    const NAME = 'bonus';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof BonusType) {
            return $value->toString();
        }

        return null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?BonusType
    {
        return $value === null ? null : BonusType::fromString($value);
    }
}