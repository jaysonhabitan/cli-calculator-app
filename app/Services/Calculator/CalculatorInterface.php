<?php

namespace App\Services\Calculator;

interface CalculatorInterface
{
    /**
     * Calculate the given numbers based on the given operation.
     *
     * @param string $operation
     * @param float $firstNum
     * @param float $secondNum
     */
    public function calculate(string $operation, float $firstNumber, ?float $secondNumber = null);
}
