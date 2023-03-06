<?php
declare(strict_types=1);

namespace App\Common;

abstract class AggregateRoot
{
    private Identity $id;

    public function __construct(Identity $id)
    {
        $this->id = $id;
    }

    public function getId(): Identity
    {
        return $this->id;
    }
}