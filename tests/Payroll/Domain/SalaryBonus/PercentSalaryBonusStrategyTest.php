<?php
declare(strict_types=1);

namespace App\Tests\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Common\PercentValue;
use App\Payroll\Domain\SalaryBonus\PercentSalaryBonusCalculator;
use PHPUnit\Framework\TestCase;

class PercentSalaryBonusStrategyTest extends TestCase
{
    public function testItShouldReturnTenMoneyUnitWhenGetTenPercentOfOneHundred()
    {
        $strategyUnderTest = new PercentSalaryBonusCalculator(PercentValue::new(10), MoneyValue::new(100));

        $result = $strategyUnderTest->calculateBonus(new \DateTimeImmutable(), new \DateTimeImmutable());

        $this->assertEquals(MoneyValue::new(10), $result);
    }

    public function testItShouldReturnZeroMoneyUnitWhenGetTenPercentOfZero()
    {
        $strategyUnderTest = new PercentSalaryBonusCalculator(PercentValue::new(10), MoneyValue::new(0));

        $result = $strategyUnderTest->calculateBonus(new \DateTimeImmutable(), new \DateTimeImmutable());

        $this->assertEquals(MoneyValue::new(0), $result);
    }
}
