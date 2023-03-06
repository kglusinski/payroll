<?php
declare(strict_types=1);

namespace App\Department\Domain;

use App\Common\AggregateRoot;
use App\Common\Identity;

class Department extends AggregateRoot
{
    private string $name;
    private SalaryBonus $salaryBonus;

    public function __construct(Identity $id, string $name)
    {
        parent::__construct($id);
        $this->name = $name;
    }

    public function assignSalaryBonus(SalaryBonus $salaryBonus): void
    {
        $this->salaryBonus = $salaryBonus;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSalaryBonus(): SalaryBonus
    {
        return $this->salaryBonus;
    }
}