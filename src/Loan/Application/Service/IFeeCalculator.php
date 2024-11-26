<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Loan\Application\Service;

use PragmaGoTech\Interview\Loan\Infrastructure\Model\LoanProposal;

interface IFeeCalculator
{
    /**
     * @return float The calculated total fee.
     */
    public function calculate(LoanProposal $application): float;
}
