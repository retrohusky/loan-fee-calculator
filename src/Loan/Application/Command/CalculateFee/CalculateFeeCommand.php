<?php

namespace PragmaGoTech\Interview\Loan\Application\Command\CalculateFee;

final readonly class CalculateFeeCommand
{
    public function __construct(
        public float $amount,
        public int $term,
    ) {
    }
}
