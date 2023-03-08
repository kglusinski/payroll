<?php
declare(strict_types=1);

namespace App\Employee\Domain;

use App\Common\AggregateRoot;
use App\Common\Identity;
use App\Common\MoneyValue;

class Employee extends AggregateRoot
{
    private string $name;
    private string $surname;
    private Identity $departmentId;

    private MoneyValue $salary;
    private \DateTimeImmutable $employmentDate;

    public function __construct(
        Identity $id,
        string $name,
        string $surname,
        Identity $departmentId,
        MoneyValue $salary
    ) {
        parent::__construct($id);
        $this->name = $name;
        $this->surname = $surname;
        $this->departmentId = $departmentId;
        $this->salary = $salary;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getDepartmentId(): Identity
    {
        return $this->departmentId;
    }

    public function getSalary(): MoneyValue
    {
        return $this->salary;
    }

    public function getEmploymentDate(): \DateTimeImmutable
    {
        return $this->employmentDate;
    }
}