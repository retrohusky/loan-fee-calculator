<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Loan\Domain\Entity;

use PragmaGoTech\Interview\Loan\Domain\ValueObject\FeeTerm;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\LoanAmount;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
readonly class LoanProposal
{
    public function __construct(
        private LoanAmount $amount,
        private FeeTerm $term,
    ) {
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): FeeTerm
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): LoanAmount
    {
        return $this->amount;
    }
}
