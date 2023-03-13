<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Common\PercentValue;

class CalculationInput
{
    public function __construct(
        public readonly \DateTimeImmutable $employmentDate,
        public readonly \DateTimeImmutable $date,
        public readonly MoneyValue $salaryBase,
        public readonly PercentValue|MoneyValue $value,
    ){}
}