<?php

namespace App\Service;

class CalculatorService
{
    public function calculateResult($inputValue)
    {
        $inputValue = preg_replace('/\s+/', '', $inputValue);

        if (empty($inputValue)) {
            return 0;
        }

        // group 1 - operand (+-*/)
        // group 2 - number (with or without "-" and with or about .float part)
        $result = preg_match_all('/(^|[-+*\/])(-?\d+(\.\d+)?)/', $inputValue, $matches);

        $operands = $matches[1];
        $numbers = array_map('floatval', $matches[2]);

        // filter first empty pseudo operand
        $operands = array_filter($operands, function ($item) {
            return !empty($item);
        });

        // reset indexes
        $operands = array_values($operands);

        while (count($operands) > 0) {
            $firstOperand = $this->searchFirstInArray(['*', '/'], $operands);

            if (false === $firstOperand) {
                $firstOperand = $this->searchFirstInArray(['+', '-'], $operands);
                if (false === $firstOperand) {
                    break;
                }
            }

            $firstOperandKey = $firstOperand['key'];
            $firstOperandVariant = $firstOperand['needle'];

            $operationResult = match ($firstOperandVariant) {
                '*' => $numbers[$firstOperandKey] * $numbers[$firstOperandKey + 1],
                '/' => $numbers[$firstOperandKey] / $numbers[$firstOperandKey + 1],
                '+' => $numbers[$firstOperandKey] + $numbers[$firstOperandKey + 1],
                '-' => $numbers[$firstOperandKey] - $numbers[$firstOperandKey + 1],
            };

            $numbers[$firstOperandKey] = $operationResult;
            unset($numbers[$firstOperandKey + 1]);
            unset($operands[$firstOperandKey]);

            $operands = array_values($operands);
            $numbers = array_values($numbers);
        }

        if (count($numbers) > 1) {
            throw new \Exception('Numbers exceed operands.');
        }

        return array_shift($numbers);
    }

    private function searchFirstInArray(array $needles, array $haystack)
    {
        $filtered = array_filter($haystack, function ($item) use ($needles) {
            return in_array($item, $needles);
        });

        if (empty($filtered)) {
            return false;
        }

        $firstKey = array_key_first($filtered);

        return [
            'key' => $firstKey,
            'needle' => $filtered[$firstKey]
        ];
    }

}
