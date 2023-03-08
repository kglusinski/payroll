<?php
declare(strict_types=1);

namespace App\Common\Infra\Doctrine\Type;

use App\Common\Identity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class IdentityType extends StringType
{
    const NAME = 'identity';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Identity) {
            return (string) $value;
        }

        return null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Identity
    {
        return $value === null ? null : Identity::fromString($value);
    }
}