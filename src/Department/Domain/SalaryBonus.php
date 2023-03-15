<?php
declare(strict_types=1);

namespace App\Department\Domain;

use App\Common\MoneyValue;
use App\Common\PercentValue;

class SalaryBonus
{
    public readonly BonusType $bonusType;

    public readonly ?PercentValue $percentValue;
    public readonly ?MoneyValue $fixedValue;

   private function __construct(BonusType $bonusType, PercentValue|MoneyValue $value)
   {
       $this->bonusType = $bonusType;

       if($bonusType === BonusType::PERCENT && $value instanceof PercentValue) {
           $this->percentValue = $value;
           return;
       }

       if($bonusType === BonusType::FIXED && $value instanceof MoneyValue) {
           $this->fixedValue = $value;
           return;
       }

       throw new \Exception('Unexpected match value');
   }

    public function getValue(): PercentValue|MoneyValue
    {
        return match ($this->bonusType) {
            BonusType::PERCENT => $this->percentValue,
            BonusType::FIXED => $this->fixedValue,
        };
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