<?php

namespace PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\Strategy;

interface IFeeCalculatorStrategy
{
    public function calculate(array $feeStructure, float $loanAmount): float;
}
