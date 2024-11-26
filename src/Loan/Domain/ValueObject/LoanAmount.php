<?php

namespace PragmaGoTech\Interview\Loan\Domain\ValueObject;

use Assert\Assert;
use PragmaGoTech\Interview\Core\Domain\ValueObject;

final class LoanAmount extends ValueObject
{
    public function __construct(mixed $value)
    {
        Assert::that($value)->numeric()->min(1000)->max(20000);

        $this->value = $value;
    }

    public function getValue(): float
    {
        return round($this->value, 2);
    }
}
