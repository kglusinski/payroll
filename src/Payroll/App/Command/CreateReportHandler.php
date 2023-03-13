<?php
declare(strict_types=1);

namespace App\Payroll\App\Command;

use App\Department\App\Query\FindById;
use App\Employee\App\Query\FindEmployed;
use App\Payroll\App\PayrollEntryFactory;
use App\Payroll\Domain\PayrollReport;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class CreateReportHandler
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus, private readonly PayrollEntryFactory $factory)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateReport $command): PayrollReport
    {
        $employees = $this->handle(new FindEmployed());

        $report = new PayrollReport();

        foreach ($employees as $employee) {
            $department = $this->handle(new FindById($employee->getDepartmentId()));

            $report->addPayrollEntry($this->factory->getPayrollEntry($command->date, $employee, $department));
        }

        return $report;
    }
}