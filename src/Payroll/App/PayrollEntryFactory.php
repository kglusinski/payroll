<?php
declare(strict_types=1);

namespace App\Payroll\App;

use App\Department\Domain\Department;
use App\Employee\Domain\Employee;
use App\Payroll\Domain\BonusType;
use App\Payroll\Domain\PayrollEntry;
use App\Payroll\Domain\SalaryBonus\CalculationInput;

class PayrollEntryFactory
{
    public function getPayrollEntry(\DateTimeImmutable $date, Employee $employee, Department $department): PayrollEntry
    {
        $bonusType = $this->toBonusType($department);
        $bonusValue = SalaryBonusFactory::getSalaryBonusCalculator($bonusType)->calculateBonus(
            new CalculationInput(
                $employee->getEmploymentDate(),
                $date,
                $employee->getSalary(),
                $department->getSalaryBonus()->getValue()
            )
        );

        return new PayrollEntry(
            $employee->getName(),
            $employee->getSurname(),
            $department->getName(),
            $employee->getSalary(),
            $bonusType,
            $bonusValue,
            $employee->getSalary()->add($bonusValue)
        );
    }

    private function toBonusType(Department $department): BonusType
    {
        return match ($department->getSalaryBonus()->bonusType->toString()) {
            'percentage' => BonusType::fromString('percentage'),
            'fixed' => BonusType::fromString('fixed'),
            default => throw new \Exception('Unexpected match value'),
        };
    }
}