<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

use App\Common\MoneyValue;
use App\Department\Domain\BonusType;
use App\Department\Domain\Department;

class PayrollEntry
{
    private string $employeeName;
    private string $employeeSurname;
    private string $department;
    private MoneyValue $baseSalary;
    private BonusType $bonusType;
    private MoneyValue $bonusValue;
    private MoneyValue $totalSalary;
}