<?php
declare(strict_types=1);

namespace App\Department\App\Command\Add;

use App\Common\Identity;
use App\Common\MoneyValue;
use App\Department\Domain\BonusType;
use App\Department\Domain\Department;
use App\Department\Domain\DepartmentRepository;
use App\Department\Domain\PercentValue;
use App\Department\Domain\SalaryBonus;

class NewDepartmentHandler
{

    public function __construct(private readonly DepartmentRepository $repository)
    {}
    public function __invoke(NewDepartment $command): void
    {
        $id = Identity::new();

        $department = new Department($id, $command->getName());

        $salaryBonus = match (BonusType::fromString($command->getSalaryBonusType())) {
            BonusType::PERCENT => SalaryBonus::createPercentBonus(new PercentValue($command->getSalaryBonusValue())),
            BonusType::FIXED => SalaryBonus::createMoneyBonus(new MoneyValue($command->getSalaryBonusValue())),
        };

        $department->assignSalaryBonus($salaryBonus);

        $this->repository->save($department);
    }
}