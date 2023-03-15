<?php
declare(strict_types=1);

namespace App\Payroll\App\Query;

class FindByName
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}