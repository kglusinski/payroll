<?php
declare(strict_types=1);

namespace App\Tests\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Common\PercentValue;
use App\Payroll\Domain\SalaryBonus\CalculationInput;
use App\Payroll\Domain\SalaryBonus\PercentSalaryBonusCalculator;
use PHPUnit\Framework\TestCase;

class PercentSalaryBonusStrategyTest extends TestCase
{
    public function testItShouldReturnTenMoneyUnitWhenGetTenPercentOfOneHundred()
    {
        $strategyUnderTest = new PercentSalaryBonusCalculator();
        $calculationInput = new CalculationInput(
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
            MoneyValue::new(100),
            PercentValue::new(10),
        );

        $result = $strategyUnderTest->calculateBonus($calculationInput);

        $this->assertEquals(MoneyValue::new(10), $result);
    }

    public function testItShouldReturnZeroMoneyUnitWhenGetTenPercentOfZero()
    {
        $strategyUnderTest = new PercentSalaryBonusCalculator();
        $calculationInput = new CalculationInput(
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
            MoneyValue::new(0),
            PercentValue::new(10),
        );

        $result = $strategyUnderTest->calculateBonus($calculationInput);

        $this->assertEquals(MoneyValue::new(0), $result);
    }
}
