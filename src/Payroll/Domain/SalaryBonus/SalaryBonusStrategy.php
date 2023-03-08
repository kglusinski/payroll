<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Employee\Domain\Employee;

interface SalaryBonusStrategy
{
    public function calculateBonus(\DateTimeImmutable $employmentDate, \DateTimeImmutable $date): MoneyValue;
}