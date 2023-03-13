<?php
declare(strict_types=1);

namespace App\Employee\App\Query;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindByIdHandler
{
    public function __construct(private readonly EmployeeRepository $repository)
    {}

    public function __invoke(FindById $query): ?Employee
    {
        return $this->repository->findById($query->id);
    }
}