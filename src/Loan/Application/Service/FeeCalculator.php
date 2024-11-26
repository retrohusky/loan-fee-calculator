<?php

namespace PragmaGoTech\Interview\Loan\Application\Service;

use PragmaGoTech\Interview\Loan\Application\Dto\FeeStructureDto;
use PragmaGoTech\Interview\Loan\Domain\Entity\LoanProposal;
use PragmaGoTech\Interview\Loan\Infrastructure\Repository\IFeeRepository;

readonly class FeeCalculator implements IFeeCalculator
{
    public function __construct(
        private IFeeRepository $feeRepository
    ) {
    }

    public function calculate(LoanProposal $loanProposal): float
    {
        $feeStructure = $this->feeRepository->getFeeStructure($loanProposal->term()->getValue());

        $loanAmount = $loanProposal->amount()->getValue();

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
