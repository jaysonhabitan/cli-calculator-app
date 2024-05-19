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

    /**
     * Adds the two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float
     */
    public function add(float $firstInput, float $secondInput);

    /**
     * Subtracts two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float
     */
    public function subtract(float $firstInput, float $secondInput);

    /**
     * Multiplies two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float
     */
    public function multiply(float $firstInput, float $secondInput);

    /**
     * Divides two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float|string
     */
    public function divide(float $firstInput, float $secondInput);

    /**
     * Square roots the given number.
     *
     * @param float $firstNum
     *
     * @return float|string
     */
    public function squareRoot(float $input);
}
