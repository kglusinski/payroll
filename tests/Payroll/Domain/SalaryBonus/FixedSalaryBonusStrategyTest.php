<?php
declare(strict_types=1);

namespace App\Tests\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Payroll\Domain\SalaryBonus\FixedSalaryBonusStrategy;
use PHPUnit\Framework\TestCase;

class FixedSalaryBonusStrategyTest extends TestCase
{
    public function testItShouldReturnZeroBonusForEmployeeHiredInLessThanYearAgo()
    {
        $strategyUnderTest = new FixedSalaryBonusStrategy(MoneyValue::new(100));

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2022-12-31');

        $result = $strategyUnderTest->calculateBonus($employmentDate, $reportDate);

        $this->assertEquals(MoneyValue::new(0), $result);
    }

    public function testItShouldReturnBonusEqualsToDepartmentBonusForEmployeeWithOneYearOfExperience()
    {
        $departmentBonus = MoneyValue::new(100);
        $strategyUnderTest = new FixedSalaryBonusStrategy($departmentBonus);

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2022-01-01');

        $result = $strategyUnderTest->calculateBonus($employmentDate, $reportDate);

        $this->assertEquals($departmentBonus, $result);
    }
    public function testItShouldReturnBonusMultipliedByEmployeeExperience()
    {
        $departmentBonus = MoneyValue::new(100);
        $strategyUnderTest = new FixedSalaryBonusStrategy($departmentBonus);

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2020-01-01');

        $result = $strategyUnderTest->calculateBonus($employmentDate, $reportDate);

        $this->assertEquals(MoneyValue::new(300), $result);
    }

    public function testItShouldReturnMaxBonusForEmployeeHiredMoreThanTenYearsAgo()
    {
        $departmentBonus = MoneyValue::new(100);
        $strategyUnderTest = new FixedSalaryBonusStrategy($departmentBonus);

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2010-01-01');

        $result = $strategyUnderTest->calculateBonus($employmentDate, $reportDate);

        $this->assertEquals(MoneyValue::new(FixedSalaryBonusStrategy::UP_TO * 100), $result);
    }
}
