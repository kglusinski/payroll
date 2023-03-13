<?php
declare(strict_types=1);

namespace App\Employee\Infra\Doctrine;

use App\Common\Identity;
use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ORMEmployeeRepository implements EmployeeRepository
{
    public function __construct(public readonly EntityManagerInterface $em)
    {}

    public function findById(Identity $id): ?Employee
    {
        return $this->em->find(Employee::class, $id);
    }

    public function findAll(): iterable
    {
        return $this->em->createQueryBuilder()
            ->select('e')
            ->from(Employee::class, 'e')
            ->getQuery()
            ->getResult();
    }
}