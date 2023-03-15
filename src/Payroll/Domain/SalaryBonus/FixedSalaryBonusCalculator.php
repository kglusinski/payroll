<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Employee\Domain\Employee;

class FixedSalaryBonusCalculator implements SalaryBonusCalculator
{
    const UP_TO = 10;

    public function calculateBonus(CalculationInput $input): MoneyValue
    {
        var_dump("FixedSalaryBonusCalculator", $input);

        $experience = $input->employmentDate->diff($input->date)->y;

        if ($experience === 0) {
            return MoneyValue::new(0);
        }

        $multiplier = min($experience, self::UP_TO);
        return $input->value?->multiply($multiplier);
    }
}