<?php
declare(strict_types=1);

namespace App\Department\Infra\Doctrine;

use App\Common\Identity;
use App\Department\Domain\Department;
use App\Department\Domain\DepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;

class ORMDeparmentRepository implements DepartmentRepository
{
    public function __construct(private readonly EntityManagerInterface $em)
    {}

    public function save(Department $department): void
    {
        $this->em->persist($department);
        $this->em->flush();
    }

    public function findById(Identity $id)
    {
        return $this->em->find(Department::class, $id);
    }
}