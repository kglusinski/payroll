<?php
declare(strict_types=1);

namespace App\Payroll\App\Command;

class CreateReport
{


    public function __construct(public readonly \DateTimeImmutable $date)
    {}
}