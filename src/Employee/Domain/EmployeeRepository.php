<?php
declare(strict_types=1);

namespace App\Employee\Domain;

use App\Common\Identity;

interface EmployeeRepository
{
    public function findById(Identity $id): ?Employee;
    public function findAll(): iterable;
}