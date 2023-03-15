<?php
declare(strict_types=1);

namespace App\Payroll\App\Query;

use App\Payroll\Domain\PayrollReport;
use App\Payroll\Domain\PayrollReportRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindByNameHandler
{
    public function __construct(
        private readonly PayrollReportRepository $repository,
    ) {
    }

    public function __invoke(FindByName $query): ?PayrollReport
    {
        return $this->repository->findByName($query->name);
    }
}