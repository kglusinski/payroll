<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Common\PercentValue;

class PercentSalaryBonusCalculator implements SalaryBonusCalculator
{
    public function calculateBonus(CalculationInput $input): MoneyValue
    {
        return $input->salaryBase->multiply($input->percentBonus?->getFloatValue());
    }
}