<?php

namespace PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator;

use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\Strategy\IFeeCalculatorStrategy;
use PragmaGoTech\Interview\Loan\Domain\Entity\LoanProposal;
use PragmaGoTech\Interview\Loan\Infrastructure\Repository\IFeeRepository;

readonly class FeeCalculator implements IFeeCalculator
{
    public function __construct(
        private IFeeRepository $feeRepository,
        private IFeeCalculatorStrategy $feeCalculatorStrategy,
    ) {
    }

    public function calculate(LoanProposal $loanProposal): float
    {
        $feeStructure = $this->feeRepository->getFeeStructure($loanProposal->term()->getValue());

        return $this->feeCalculatorStrategy->calculate($feeStructure, $loanProposal->amount()->getValue());
    }
}
