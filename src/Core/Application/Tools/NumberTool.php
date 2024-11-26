<?php

namespace PragmaGoTech\Interview\Core\Application\Tools;

class NumberTool
{
    public static function roundInt(float $value, int $dividend): float
    {
        if ($dividend <= 0) {
            throw new \InvalidArgumentException('Dividend must be greater than 0');
        }

        return round(round($value / $dividend) * $dividend, 2);
    }
}
