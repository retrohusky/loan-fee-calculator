<?php

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\FeeValue;

class FeeValueTest extends TestCase
{
    public function testValidNumericFeeValue()
    {
        $value = 123.456789;
        $feeValue = new FeeValue($value);
        $expected = 125;
        $this->assertEquals($expected, $feeValue->getValue());
    }

    public function testValidIntegerFeeValue()
    {
        $value = 120;
        $feeValue = new FeeValue($value);
        $expected = 120;
        $this->assertEquals($expected, $feeValue->getValue());
    }

    public function testValidNegativeNumericFeeValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $value = -123.456789;
        new FeeValue($value);
    }

    public function testInvalidStringFeeValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        new FeeValue("not a number");
    }

    public function testNullFeeValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        new FeeValue(null);
    }
}