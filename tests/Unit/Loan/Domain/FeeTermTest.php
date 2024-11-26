<?php

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Loan\Domain\Enum\FeeTermEnum;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\FeeTerm;

class FeeTermTest extends TestCase
{
    public function testValidFeeTerm()
    {
        $term = new FeeTerm(FeeTermEnum::TWELVE_MONTHS->value);
        $this->assertEquals(12, $term->getValue());
    }

    public function testAnotherValidFeeTerm()
    {
        $term = new FeeTerm(FeeTermEnum::TWENTY_FOUR_MONTHS->value);
        $this->assertEquals(24, $term->getValue());
    }

    public function testInvalidFeeTerm()
    {
        $this->expectException(\InvalidArgumentException::class);
        new FeeTerm('invalid');
    }

    public function testNullFeeTerm()
    {
        $this->expectException(\InvalidArgumentException::class);
        new FeeTerm(null);
    }
}