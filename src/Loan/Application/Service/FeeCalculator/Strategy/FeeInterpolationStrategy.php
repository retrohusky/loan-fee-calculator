<?php

namespace PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\Strategy;

use PragmaGoTech\Interview\Loan\Application\Dto\FeeStructureDto;

class FeeInterpolationStrategy implements IFeeCalculatorStrategy
{
    public function calculate(array $feeStructure, float $loanAmount): float
    {
        $lowerBound = null;
        $upperBound = null;

        foreach ($feeStructure as $feeDto) {
            if ($feeDto->loan == $loanAmount) {
                return $feeDto->fee;
            }

            if ($feeDto->loan < $loanAmount) {
                $lowerBound = $feeDto;
            }

            if ($feeDto->loan > $loanAmount && !$upperBound) {
                $upperBound = $feeDto;
                break;
            }
        }

        if (!$lowerBound || !$upperBound) {
            throw new \InvalidArgumentException('Loan amount is out of the fee structure range.');
        }

        return $this->interpolateFee($lowerBound, $upperBound, $loanAmount);
    }

    private function interpolateFee(
        FeeStructureDto $lower,
        FeeStructureDto $upper,
        float $loanAmount
    ): float {
        $slope = ($upper->fee - $lower->fee) / ($upper->loan - $lower->loan);
        return $lower->fee + ($loanAmount - $lower->loan) * $slope;
    }
}
