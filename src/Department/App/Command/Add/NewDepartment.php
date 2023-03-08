<?php
declare(strict_types=1);

namespace App\Department\App\Add;

class NewDepartment
{
    private string $name;
    private string $salaryBonusType;
    private int $salaryBonusValue;

    public function getName()
    {
        return $this->name;
    }

    public function getSalaryBonusType(): string
    {
        return $this->salaryBonusType;
    }

    public function getSalaryBonusValue(): int
    {
        return $this->salaryBonusValue;
    }
}