<?php

namespace PragmaGoTech\Interview\Loan\Domain\ValueObject;

use Assert\Assert;
use PragmaGoTech\Interview\Core\Application\Tools\NumberTool;
use PragmaGoTech\Interview\Core\Domain\ValueObject;

final class FeeValue extends ValueObject
{
    public function __construct(mixed $value)
    {
        Assert::that($value)->numeric()->min(0);
        $this->value = $value;
    }

    public function getValue(): float
    {
        return NumberTool::roundInt($this->value, 5);
    }
}
