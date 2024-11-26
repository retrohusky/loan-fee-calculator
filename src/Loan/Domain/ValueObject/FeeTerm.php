<?php

namespace PragmaGoTech\Interview\Loan\Domain\ValueObject;

use Assert\Assert;
use PragmaGoTech\Interview\Core\Domain\ValueObject;
use PragmaGoTech\Interview\Loan\Domain\Enum\FeeTermEnum;

final class FeeTerm extends ValueObject
{
    public function __construct(mixed $value)
    {

        $validValues = array_map(fn (FeeTermEnum $enum) => $enum->value, FeeTermEnum::cases());

        Assert::that($value)->notNull()->integer()->inArray($validValues);

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
