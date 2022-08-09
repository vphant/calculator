<?php

namespace App\Service;

class CalculatorService
{
    public function calculateResult($inputValue)
    {
        if (empty($inputValue)) {
            return 0;
        }

        // group 1 - operand (+-*/)
        // group 2 - number (with or without - and with or about .float part)
        $result = preg_match_all('/(^|[-+*\/])(-?\d+(\.\d+)?)/', $inputValue, $mathes);

        $operands = $mathes[1];
        $numbers = $mathes[2];

        return 9999999;
    }
}
