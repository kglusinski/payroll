<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

use App\Common\MoneyValue;

class PayrollEntry
{
    private string $employeeName;
    private string $employeeSurname;
    private string $department;
    private MoneyValue $baseSalary;
    private BonusType $bonusType;
    private MoneyValue $bonusValue;
    private MoneyValue $totalSalary;

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