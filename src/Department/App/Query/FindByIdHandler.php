<?php
declare(strict_types=1);

namespace App\Department\App\Query;

use App\Department\Domain\Department;
use App\Department\Domain\DepartmentRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindByIdHandler
{
    public function __construct(private readonly DepartmentRepository $repository)
    {}

    public function __invoke(FindById $query): ?Department
    {
        return $this->repository->findById($query->id);
    }
}