<?php

namespace Unit\Loan\Application\Service;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Loan\Application\Dto\FeeStructureDto;
use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\FeeCalculator;
use PragmaGoTech\Interview\Loan\Application\Service\FeeCalculator\Strategy\FeeInterpolationStrategy;
use PragmaGoTech\Interview\Loan\Domain\Entity\LoanProposal;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\FeeTerm;
use PragmaGoTech\Interview\Loan\Domain\ValueObject\LoanAmount;
use PragmaGoTech\Interview\Loan\Infrastructure\Repository\IFeeRepository;

class FeeCalculatorTest extends TestCase
{
    private FeeCalculator $calculator;
    private IFeeRepository $feeRepository;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->feeRepository = $this->createMock(IFeeRepository::class);
        $this->calculator = new FeeCalculator($this->feeRepository, new FeeInterpolationStrategy());
    }

    public function testExactBreakpointReturnsCorrectFee(): void
    {
        $term = 12;
        $loanAmount = 5000;
        $expectedFee = 100;

        $this->feeRepository
            ->method('getFeeStructure')
            ->with($term)
            ->willReturn([
                new FeeStructureDto([
                    'loan' => 5000,
                    'fee' => 100
                ]),
                new FeeStructureDto([
                    'loan' => 6000,
                    'fee' => 120
                    ]),
            ]);

        $loanProposal = new LoanProposal(new LoanAmount($loanAmount), new FeeTerm($term));
        $fee = $this->calculator->calculate($loanProposal);

        $this->assertEquals($expectedFee, $fee);
    }

    public function testInterpolationBetweenBreakpoints(): void
    {
        $term = 24;
        $loanAmount = 7500;
        $expectedFee = 300;

        $this->feeRepository
            ->method('getFeeStructure')
            ->with($term)
            ->willReturn([
                new FeeStructureDto([
                    'loan' => 7000,
                    'fee' => 280
                ]),
                new FeeStructureDto([
                    'loan' => 8000,
                    'fee' => 320
                ]),
            ]);

        $loanProposal = new LoanProposal(new LoanAmount($loanAmount), new FeeTerm($term));
        $fee = $this->calculator->calculate($loanProposal);

        $this->assertEquals($expectedFee, $fee);
    }

    public function testRoundingToNearestFive(): void
    {
        $term = 12;
        $loanAmount = 5500;
        $expectedFee = 110;

        $this->feeRepository
            ->method('getFeeStructure')
            ->with($term)
            ->willReturn([
                new FeeStructureDto([
                    'loan' => 5000,
                    'fee' => 100
                ]),
                new FeeStructureDto([
                    'loan' => 6000,
                    'fee' => 120
                ]),
            ]);

        $loanProposal = new LoanProposal(new LoanAmount($loanAmount), new FeeTerm($term));
        $fee = $this->calculator->calculate($loanProposal);

        $this->assertEquals($expectedFee, $fee);
    }

    public function testThrowsExceptionForOutOfRangeLoanAmount(): void
    {
        $term = 24;
        $loanAmount = 900;
        $this->feeRepository
            ->method('getFeeStructure')
            ->with($term)
            ->willReturn([
                new FeeStructureDto([
                    'loan' => 1000,
                    'fee' => 70
                ]),
                new FeeStructureDto([
                    'loan' => 2000,
                    'fee' => 100
                ]),
            ]);

        $this->expectException(\InvalidArgumentException::class);
        $loanProposal = new LoanProposal(new LoanAmount($loanAmount), new FeeTerm($term));
        $this->calculator->calculate($loanProposal);
    }


}
