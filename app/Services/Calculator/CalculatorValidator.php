<?php

namespace App\Services\Calculator;

use App\Enum\CalculatorErrorMessages;
use App\Enum\CalculatorOperations;

class CalculatorValidator
{
    /**
     * Validate the given operation of the user.
     *
     * @param string $operation
     *
     * @return string
     */
    public function isValidOperation(string $operation)
    {
        $allowedOperations = array_values(CalculatorOperations::all());

        return in_array($operation, $allowedOperations);
    }

    /**
     * Validates if the given input is valid.
     *
     * @param string
     *
     * @return bool
     */
    public function isNumber(string $number)
    {
        return preg_match('/^-?\d+(\.\d+)?$/', $number);
    }

    /**
     * Validate if the given value to square root is valid
     *
     * @param float
     *
     * @return string|void
     */
    public function isValidSquareRootNum(float $firstNum)
    {
        return $firstNum > 0;
    }
}
