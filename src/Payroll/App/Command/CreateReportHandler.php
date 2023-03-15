<?php
declare(strict_types=1);

namespace App\Payroll\App\Command;

use App\Common\Identity;
use App\Department\App\Query\FindById;
use App\Employee\App\Query\FindEmployed;
use App\Payroll\App\PayrollEntryFactory;
use App\Payroll\Domain\PayrollReport;
use App\Payroll\Domain\PayrollReportRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class CreateReportHandler
{
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private readonly PayrollEntryFactory $factory,
        private readonly PayrollReportRepository $repository
    )
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateReport $command): void
    {
        $employees = $this->handle(new FindEmployed());

        $report = new PayrollReport(Identity::new(), $command->date);

        foreach ($employees as $employee) {
            $department = $this->handle(new FindById($employee->getDepartmentId()));

            $report->addPayrollEntry($this->factory->getPayrollEntry($command->date, $employee, $department));
        }

        $this->repository->save($report);
    }
}