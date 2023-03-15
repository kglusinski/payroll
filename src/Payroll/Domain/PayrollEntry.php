<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

use App\Common\Identity;
use App\Common\MoneyValue;

class PayrollEntry
{
    public readonly string $employeeName;
    public readonly string $employeeSurname;
    public readonly string $department;
    public readonly MoneyValue $baseSalary;
    public readonly BonusType $bonusType;
    public readonly MoneyValue $bonusValue;
    public readonly MoneyValue $totalSalary;

    public function __construct(string $employeeName, string $employeeSurname, string $department, MoneyValue $baseSalary, BonusType $bonusType, MoneyValue $bonusValue, MoneyValue $totalSalary)
    {
        $this->employeeName = $employeeName;
        $this->employeeSurname = $employeeSurname;
        $this->department = $department;
        $this->baseSalary = $baseSalary;
        $this->bonusType = $bonusType;
        $this->bonusValue = $bonusValue;
        $this->totalSalary = $totalSalary;
    }
}