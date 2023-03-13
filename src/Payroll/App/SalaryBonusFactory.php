<?php
declare(strict_types=1);

namespace App\Payroll\App;

use App\Payroll\Domain\BonusType;
use App\Payroll\Domain\SalaryBonus\FixedSalaryBonusCalculator;
use App\Payroll\Domain\SalaryBonus\PercentSalaryBonusCalculator;
use App\Payroll\Domain\SalaryBonus\SalaryBonusCalculator;

class SalaryBonusFactory
{
    public static function getSalaryBonusCalculator(BonusType $bonusType): SalaryBonusCalculator
    {
        return match ($bonusType) {
            BonusType::FIXED => new FixedSalaryBonusCalculator(),
            BonusType::PERCENT => new PercentSalaryBonusCalculator(),
        };
    }
}