<?php
declare(strict_types=1);

namespace App\Tests\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Payroll\Domain\SalaryBonus\CalculationInput;
use App\Payroll\Domain\SalaryBonus\FixedSalaryBonusCalculator;
use PHPUnit\Framework\TestCase;

class FixedSalaryBonusStrategyTest extends TestCase
{
    public function testItShouldReturnZeroBonusForEmployeeHiredInLessThanYearAgo()
    {
        $strategyUnderTest = new FixedSalaryBonusCalculator();

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2022-12-31');

        $calculationInput = new CalculationInput($employmentDate, $reportDate, MoneyValue::new(1000), MoneyValue::new(100));

        $result = $strategyUnderTest->calculateBonus($calculationInput);

        $this->assertEquals(MoneyValue::new(0), $result);
    }

    public function testItShouldReturnBonusEqualsToDepartmentBonusForEmployeeWithOneYearOfExperience()
    {
        $departmentBonus = MoneyValue::new(100);
        $strategyUnderTest = new FixedSalaryBonusCalculator();

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2022-01-01');

        $calculationInput = new CalculationInput($employmentDate, $reportDate, MoneyValue::new(1000), $departmentBonus);

        $result = $strategyUnderTest->calculateBonus($calculationInput);

        $this->assertEquals($departmentBonus, $result);
    }
    public function testItShouldReturnBonusMultipliedByEmployeeExperience()
    {
        $departmentBonus = MoneyValue::new(100);
        $strategyUnderTest = new FixedSalaryBonusCalculator();

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2020-01-01');

        $calculationInput = new CalculationInput($employmentDate, $reportDate, MoneyValue::new(1000), $departmentBonus);

        $result = $strategyUnderTest->calculateBonus($calculationInput);

        $this->assertEquals(MoneyValue::new(300), $result);
    }

    public function testItShouldReturnMaxBonusForEmployeeHiredMoreThanTenYearsAgo()
    {
        $departmentBonus = MoneyValue::new(100);
        $strategyUnderTest = new FixedSalaryBonusCalculator();

        $reportDate = new \DateTimeImmutable('2023-01-01');
        $employmentDate = new \DateTimeImmutable('2010-01-01');

        $calculationInput = new CalculationInput($employmentDate, $reportDate, MoneyValue::new(1000), $departmentBonus);

        $result = $strategyUnderTest->calculateBonus($calculationInput);

        $this->assertEquals(MoneyValue::new(FixedSalaryBonusCalculator::UP_TO * 100), $result);
    }
}
