<?php

namespace App\DataFixtures;

use App\Common\Identity;
use App\Common\MoneyValue;
use App\Common\PercentValue;
use App\Department\Domain\Department;
use App\Department\Domain\SalaryBonus;
use App\Employee\Domain\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dep = $manager->find(Department::class, "98897ef6-f7f5-4895-ba72-27873f915f2b");

        // Departments
        $departmentIT = new Department(Identity::new(), "IT");
        $departmentHR = new Department(Identity::new(), "HR");

        $departmentIT->assignSalaryBonus(SalaryBonus::createMoneyBonus(MoneyValue::new(1000)));
        $departmentHR->assignSalaryBonus(SalaryBonus::createPercentBonus(PercentValue::new(20)));

        $employee = new Employee(
            Identity::new(),
            "John",
            "Doe",
            $departmentIT->getId(),
            MoneyValue::new(1200),
            new \DateTimeImmutable()
        );

        $employee2 = new Employee(
            Identity::new(),
            "Jane",
            "Doe",
            $departmentHR->getId(),
            MoneyValue::new(1000),
            new \DateTimeImmutable()
        );

        $manager->persist($departmentIT);
        $manager->persist($departmentHR);
        $manager->persist($employee);
        $manager->persist($employee2);

        $manager->flush();
    }
}
