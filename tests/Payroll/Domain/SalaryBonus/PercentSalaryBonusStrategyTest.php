<?php
declare(strict_types=1);

namespace App\Tests\Payroll\Domain\SalaryBonus;

use App\Common\MoneyValue;
use App\Department\Domain\PercentValue;
use App\Payroll\Domain\SalaryBonus\PercentSalaryBonusStrategy;
use PHPUnit\Framework\TestCase;

class PercentSalaryBonusStrategyTest extends TestCase
{
    public function testItShouldReturnTenMoneyUnitWhenGetTenPercentOfOneHundred()
    {
        $strategyUnderTest = new PercentSalaryBonusStrategy(PercentValue::new(10), MoneyValue::new(100));

        $result = $strategyUnderTest->calculateBonus(new \DateTimeImmutable(), new \DateTimeImmutable());

        $this->assertEquals(MoneyValue::new(10), $result);
    }

    public function testItShouldReturnZeroMoneyUnitWhenGetTenPercentOfZero()
    {
        $strategyUnderTest = new PercentSalaryBonusStrategy(PercentValue::new(10), MoneyValue::new(0));

        $result = $strategyUnderTest->calculateBonus(new \DateTimeImmutable(), new \DateTimeImmutable());

        $this->assertEquals(MoneyValue::new(0), $result);
    }
}
