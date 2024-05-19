<?php

namespace App\Enum;

class CalculatorErrorMessages
{
    const INVALID_INPUT = "Invalid input, not a number.";
    const CANNOT_BE_EMPTY = "Operation cannot be empty.";
    const CANNOT_BE_DIVIDE_BY_ZERO = "Invalid input, cannot be divide by zero.";
    const CANNOT_SQUARE_NEGATIVE_NUMBER = "Invalid input, cannot square root a negative number.";

    /**
     * Return an error message.
     *
     * @return string
     */
    public static function invalidOperation()
    {
        $errorMessage = "Invalid operation. \n";
        $errorMessage .= "These are the only valid operations: ". implode(', ', CalculatorOperations::all());

        return $errorMessage;
    }
}
