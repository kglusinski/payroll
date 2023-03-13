<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Employee\Domain\Employee;

interface SalaryBonusCalculator
{
    public function calculateBonus(CalculationInput $input): MoneyValue;
}