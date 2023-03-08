<?php
declare(strict_types=1);

namespace App\Department\Infra\Doctrine;

use App\Department\Domain\Department;
use App\Department\Domain\DepartmentRepository;
use Doctrine\ORM\EntityManager;

class ORMDeparmentRepository implements DepartmentRepository
{
    public function __construct(private readonly EntityManager $em)
    {}

    public function save(Department $department): void
    {
        $this->em->persist($department);
        $this->em->flush();
    }
}