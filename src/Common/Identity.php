<?php
declare(strict_types=1);

namespace App\Common;

use Ramsey\Uuid\Uuid;

final class Identity
{
    private string $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public static function new(): self
    {
        return new self(Uuid::getFactory()->uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->id;
    }
}