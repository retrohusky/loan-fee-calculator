<?php

namespace PragmaGoTech\Interview\Core\Domain;

abstract class ValueObject implements IValueObject
{
    protected mixed $value;

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
