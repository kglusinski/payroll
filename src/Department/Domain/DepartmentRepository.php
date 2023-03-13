<?php
declare(strict_types=1);

namespace App\Department\Domain;

use App\Common\Identity;

interface DepartmentRepository
{
    public function save(Department $department): void;

    public function findById(Identity $id);
}