<?php
declare(strict_types=1);

namespace App\Command;

use App\Common\Identity;
use App\Employee\App\Query\FindById;
use App\Employee\App\Query\FindByIdHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:employee:find-by-id',
    description: 'Find an employee by ID',
    aliases: ['find'],
    hidden: false,
)]
class FindEmployeeByID extends Command
{
    public function __construct(private readonly FindByIdHandler $handler, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to find an employee by ID')
            ->addArgument('id', InputArgument::REQUIRED, 'The employee ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $idRaw = $input->getArgument('id');
        $id = Identity::fromString($idRaw);
        $employee = $this->handler->__invoke(new FindById($id));

        if ($employee) {
            $output->writeln('Employee found: ' . $employee->getFullName());
        } else {
            $output->writeln('Employee not found');
        }

        return Command::SUCCESS;
    }
}