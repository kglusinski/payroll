<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Employee\Domain\Employee;

class FixedSalaryBonusStrategy implements SalaryBonusStrategy
{
    const UP_TO = 10;

    private MoneyValue $bonus;

    public function __construct(MoneyValue $bonus)
    {
        $this->bonus = $bonus;
    }

    public function calculateBonus(\DateTimeImmutable $employmentDate, \DateTimeImmutable $date): MoneyValue
    {
        $experience = $employmentDate->diff($date)->y;

        if ($experience === 0) {
            return MoneyValue::new(0);
        }

        $multiplier = min($experience, self::UP_TO);
        return $this->bonus->multiply($multiplier);
    }
}