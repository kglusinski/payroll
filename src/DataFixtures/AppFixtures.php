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

        $employee3 = new Employee(
            Identity::new(),
            "Max",
            "Kowalsky",
            $departmentIT->getId(),
            MoneyValue::new(1300),
            new \DateTimeImmutable('2020-01-01')
        );

        $employee4 = new Employee(
            Identity::new(),
            "Jane",
            "Smith",
            $departmentHR->getId(),
            MoneyValue::new(1500),
            new \DateTimeImmutable('2020-01-01')
        );

        $employee5 = new Employee(
            Identity::new(),
            "Cloe",
            "Doe",
            $departmentHR->getId(),
            MoneyValue::new(1000),
            new \DateTimeImmutable('2019-11-01')
        );

        $manager->persist($departmentIT);
        $manager->persist($departmentHR);
        $manager->persist($employee);
        $manager->persist($employee2);
        $manager->persist($employee3);
        $manager->persist($employee4);
        $manager->persist($employee5);

        $manager->flush();
    }
}
