<?php

namespace PragmaGoTech\Interview\Loan\Application\Command\CalculateFee;

use PragmaGoTech\Interview\Loan\Application\Service\IFeeCalculator;
use PragmaGoTech\Interview\Loan\Domain\Entity\LoanProposal;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\FeeTerm;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\FeeValue;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\LoanAmount;

final readonly class CalculateFeeHandler
{
    public function __construct(
        private IFeeCalculator $feeCalculator,
    ) {
    }

    public function handle(CalculateFeeCommand $command): float
    {
        $loanProposal = new LoanProposal(
            new LoanAmount($command->amount),
            new FeeTerm($command->term),
        );

        $fee = new FeeValue($this->feeCalculator->calculate($loanProposal));

        return $fee->getValue();
    }
}
