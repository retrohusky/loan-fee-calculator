<?php

namespace PragmaGoTech\Interview\Loan\Infrastructure\Console;

use PragmaGoTech\Interview\Core\Application\CommandBus;
use PragmaGoTech\Interview\Loan\Application\Command\CalculateFee\CalculateFeeCommand;

readonly class CalculateFeeController
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    public function run(): void
    {
        echo "Enter loan amount (e.g., 5500): ";
        $amount = (float) trim(fgets(STDIN));

        echo "Enter term (12 or 24 months): ";
        $term = (int) trim(fgets(STDIN));

        try {
            $command = new CalculateFeeCommand(amount: $amount, term: $term);

            /**
             * @var $fee string
             */
            $fee = $this->commandBus->handle($command);

            echo "The calculated fee for a loan of {$amount} PLN over {$term} months is: {$fee} PLN\n";

        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}
