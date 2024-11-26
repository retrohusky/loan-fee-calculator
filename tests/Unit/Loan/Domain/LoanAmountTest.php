<?php

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\LoanAmount;

class LoanAmountTest extends TestCase
{
    public function testValidLoanAmount()
    {
        $amount = new LoanAmount(1500);
        $this->assertEquals(1500.00, $amount->getValue());
    }

    public function testLoanAmountAtMinimumBoundary()
    {
        $amount = new LoanAmount(1000);
        $this->assertEquals(1000.00, $amount->getValue());
    }

    public function testLoanAmountAtMaximumBoundary()
    {
        $amount = new LoanAmount(20000);
        $this->assertEquals(20000.00, $amount->getValue());
    }

    public function testInvalidLoanAmountBelowMinimum()
    {
        $this->expectException(\InvalidArgumentException::class);
        new LoanAmount(999);
    }

    public function testInvalidLoanAmountAboveMaximum()
    {
        $this->expectException(\InvalidArgumentException::class);
        new LoanAmount(20001);
    }

    public function testInvalidNonNumericLoanAmount()
    {
        $this->expectException(\InvalidArgumentException::class);
        new LoanAmount('invalid');
    }
}
