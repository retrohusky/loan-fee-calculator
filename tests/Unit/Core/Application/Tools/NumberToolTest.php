<?php

namespace Tests\Unit\Core\Application\Tools;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Core\Application\Tools\NumberRoundingTool;

class NumberToolTest extends TestCase
{
    public function testRoundIntPositiveValue()
    {
        $value = 123.456;
        $dividend = 5;
        $this->assertEquals(125, NumberRoundingTool::roundUpToNearestMultiple($value, $dividend));
    }

    public function testRoundIntPositiveValueWithDifferentDividend()
    {
        $value = 123.456;
        $dividend = 10;

        $this->assertEquals(130, NumberRoundingTool::roundUpToNearestMultiple($value, $dividend));
    }

    public function testRoundIntNegativeValue()
    {
        $value = -123.456;
        $dividend = 5;

        $this->assertEquals(-120, NumberRoundingTool::roundUpToNearestMultiple($value, $dividend));
    }

    public function testRoundIntZeroDividend()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Dividend must be greater than 0');

        NumberRoundingTool::roundUpToNearestMultiple(123.456, 0);
    }

    public function testRoundIntNegativeDividend()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Dividend must be greater than 0');

        NumberRoundingTool::roundUpToNearestMultiple(123.456, -5);
    }
}
