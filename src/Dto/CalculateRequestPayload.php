<?php

namespace App\Dto;

use App\Validator as AppAssert;

class CalculateRequestPayload
{
    /**
     * @AppAssert\InputValue()
     */
    private string $inputValue;

    /**
     * @return string
     */
    public function getInputValue(): string
    {
        return $this->inputValue;
    }

    /**
     * @param string $inputValue
     */
    public function setInputValue(string $inputValue): void
    {
        // remove all spaces from a string
        $this->inputValue = preg_replace('/\s+/', '', $inputValue);
    }

}
