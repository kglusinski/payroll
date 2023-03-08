<?php
declare(strict_types=1);

namespace App\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Department\Domain\PercentValue;

class PercentSalaryBonusStrategy implements SalaryBonusStrategy
{
    private PercentValue $percent;
    private MoneyValue $base;

    public function __construct(PercentValue $percent, MoneyValue $base)
    {
        $this->percent = $percent;
        $this->base = $base;
    }

    public function calculateBonus(\DateTimeImmutable $employmentDate, \DateTimeImmutable $date): MoneyValue
    {
        return $this->base->multiply($this->percent->getFloatValue());
    }
}