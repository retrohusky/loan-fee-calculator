<?php

namespace PragmaGoTech\Interview\Loan\Infrastructure\Repository;

use PragmaGoTech\Interview\Loan\Application\Dto\FeeStructureDto;

interface IFeeRepository
{
    /**
     * @param int $term
     * @return FeeStructureDto[]
     */
    public function getFeeStructure(int $term): array;
}
