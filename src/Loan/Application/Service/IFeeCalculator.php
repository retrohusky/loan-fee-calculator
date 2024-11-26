<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Loan\Application\Service;

use PragmaGoTech\Interview\Loan\Domain\Entity\LoanProposal;

interface IFeeCalculator
{
    public function calculate(LoanProposal $loanProposal): float;
}
