<?php
declare(strict_types=1);

namespace App\Command;

use App\Payroll\App\Command\CreateReport;
use App\Payroll\App\Query\FindByName;
use App\Payroll\Domain\PayrollReport;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:payroll:get',
    description: 'Generate and get a payroll report',
    aliases: ['report'],
    hidden: false,
)]
class GetPayrollReport extends Command
{
    use HandleTrait;

    const ARG_DATE = 'date';
    const OPT_SORT_BY = 'sortBy';
    const OPT_FILTER_BY = 'filterBy';
    const OPT_FILTER_VALUE = 'filterValue';
    const OPT_SORT_DIRECTION = 'sortDir';

    public function __construct(private readonly MessageBusInterface $bus, string $name = null)
    {
        $this->messageBus = $bus;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $today = (new \DateTimeImmutable('now'))->format('Y-m-d');

        $this
            ->setHelp('This command allows you to find an employee by ID')
            ->addArgument(self::ARG_DATE, InputArgument::OPTIONAL, 'The date of the report in format: Y-m-d', $today)
            ->addOption(
                self::OPT_SORT_BY,
                null,
                InputOption::VALUE_OPTIONAL,
                'Sort result by any field (single): name, surname, department, baseSalary, bonusType, bonusValue, totalSalary',
            )
            ->addOption(
                self::OPT_SORT_DIRECTION,
                null,
                InputOption::VALUE_OPTIONAL,
                'Sort result direction (one of): asc, desc',
                'asc'
            )
            ->addOption(
                self::OPT_FILTER_BY,
                null,
                InputOption::VALUE_OPTIONAL,
                'Filter by department, employee name or surname')
            ->addOption(
                self::OPT_FILTER_VALUE,
                null,
                InputOption::VALUE_OPTIONAL,
                'Filter value',
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $input->getArgument(self::ARG_DATE));

        $this->handle(new CreateReport($date));

        $report = $this->handle(new FindByName($date->format('F Y')));

        if ($input->getOption(self::OPT_FILTER_BY) && $input->getOption(self::OPT_FILTER_VALUE)) {
            $report->filter(
                $this->mapFilterName($input->getOption(self::OPT_FILTER_BY)),
                $input->getOption(self::OPT_FILTER_VALUE)
            );
        }

        if ($input->getOption(self::OPT_SORT_BY)) {
            $report->sort($this->mapSortName($input->getOption(self::OPT_SORT_BY)), $this->mapSortDirection($input->getOption(self::OPT_SORT_DIRECTION)));
        }

        $output->writeln('<info>Report created.</info>');
        $output->writeln("<info>Month: $report->name</info>");
        $this->renderTable($output, $report);

        return Command::SUCCESS;
    }

    private function renderTable(OutputInterface $output, PayrollReport $report): void
    {
        $table = new Table($output);
        $table->setHeaders(['Name', 'Surname', 'Department', 'Base Salary', 'Bonus Type', 'Bonus Value', 'Total']);
        foreach ($report->getPayrollEntries() as $payrollEntry) {
            $table->addRow([
                $payrollEntry->employeeName,
                $payrollEntry->employeeSurname,
                $payrollEntry->department,
                $payrollEntry->baseSalary,
                $payrollEntry->bonusType->toString(),
                $payrollEntry->bonusValue,
                $payrollEntry->totalSalary,
            ]);
        }
        $table->render();
    }

    private function mapFilterName(string $filterBy): string
    {
        return match (strtolower($filterBy)) {
            'name' => 'employeeName',
            'surname' => 'employeeSurname',
            'department' => 'department',
            default => throw new \InvalidArgumentException('Invalid filter field'),
        };
    }

    private function mapSortName(string $sortBy): string
    {
        return match ($sortBy) {
            'name' => 'employeeName',
            'surname' => 'employeeSurname',
            'department' => 'department',
            'baseSalary' => 'baseSalary',
            'bonusType' => 'bonusType',
            'bonusValue' => 'bonusValue',
            'totalSalary' => 'totalSalary',
            default => throw new \InvalidArgumentException('Invalid sort field'),
        };
    }

    private function mapSortDirection(string $sortDir): string
    {
        return match (strtolower($sortDir)) {
            'asc' => 'asc',
            'desc' => 'desc',
            default => throw new \InvalidArgumentException('Invalid sort direction'),
        };
    }
}