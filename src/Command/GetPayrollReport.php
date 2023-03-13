<?php
declare(strict_types=1);

namespace App\Command;

use App\Payroll\App\Command\CreateReport;
use App\Payroll\Domain\PayrollReport;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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

    public function __construct(private readonly MessageBusInterface $bus, string $name = null)
    {
        $this->messageBus = $bus;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to find an employee by ID')
            ->addArgument('date', InputArgument::REQUIRED, 'The date of the report in format: Y-m-d')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var PayrollReport $report */
        $report = $this->handle(
            new CreateReport(
                \DateTimeImmutable::createFromFormat('Y-m-d', $input->getArgument('date'))
            )
        );

        $output->writeln('<info>Report created.</info>');

        return Command::SUCCESS;
    }
}