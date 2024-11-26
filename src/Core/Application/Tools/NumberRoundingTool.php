<?php

namespace PragmaGoTech\Interview\Core\Application\Tools;

class NumberRoundingTool
{
    public static function roundUpToNearestMultiple(float $value, int $dividend): float
    {
        if ($dividend <= 0) {
            throw new \InvalidArgumentException('Dividend must be greater than 0');
        }

        return ceil($value / $dividend) * $dividend;
    }
}
