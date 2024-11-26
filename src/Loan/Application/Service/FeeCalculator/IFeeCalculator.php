<?php

namespace PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator;

use PragmaGoTech\Interview\Loan\Domain\Entity\LoanProposal;

interface IFeeCalculator
{
    public function calculate(LoanProposal $loanProposal): float;
}
