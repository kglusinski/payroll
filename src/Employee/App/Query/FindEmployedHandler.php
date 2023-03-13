<?php
declare(strict_types=1);

namespace App\Employee\App\Query;

use App\Employee\Domain\EmployeeRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindEmployedHandler
{

    public function __construct(private readonly EmployeeRepository $employeeRepository)
    {
    }

    public function __invoke(FindEmployed $query): iterable
    {
        return $this->employeeRepository->findAll();
    }
}