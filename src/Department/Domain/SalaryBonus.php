<?php
declare(strict_types=1);

namespace App\Department\Domain;

use App\Common\MoneyValue;
use App\Common\PercentValue;

class SalaryBonus
{
    public readonly BonusType $bonusType;

    public readonly PercentValue|MoneyValue $value;

   private function __construct(BonusType $bonusType, PercentValue|MoneyValue $value)
   {
       $this->bonusType = $bonusType;
       $this->value = $value;
   }

    public static function createPercentBonus(PercentValue $value): self
    {
         return new self(BonusType::PERCENT, $value);
    }

    public static function createMoneyBonus(MoneyValue $value): self
    {
         return new self(BonusType::FIXED, $value);
    }
}