<?php

namespace App\Services\Calculator;

use App\Enum\CalculatorErrorMessages;
use App\Enum\CalculatorOperations;
use Exception;

class Calculator implements CalculatorInterface
{

    /**
     * Gives the instruction for using the calculator.
     *
     * @return string
     */
    public function init()
    {
        $message = "This is a CLI Calculator.\n";
        $message .= "You can add, subtract, multiply, divide, a given pair of numbers, or even square root a number. \n";
        $message .= "Here are the available operations: \n";
        $message .= "1. + (for addition) \n";
        $message .= "2. - (for subtraction) \n";
        $message .= "3. * (for multiplication) \n";
        $message .= "4. / (for division) \n";
        $message .= "5. sqrt (for square root) \n";

        return $message;
    }

    /**
     * Calculate the given numbers based on the given operation.
     *
     * @param string $operation
     * @param float $firstNum
     * @param float $secondNum
     */
    public function calculate(string $operation, float $firstNumber, ?float $secondNumber = null)
    {
        $result = [
            'success' => true,
            'data' => null,
            'message' => null
        ];

        /**
         * TODO: Functions like add, subtract, etc.. can be separated to it's own class.
         * Then implement a dependency injection.
         */
        try {
            switch ($operation) {
                case CalculatorOperations::ADDITION:
                    $data = self::add($firstNumber, $secondNumber);
                    break;
                case CalculatorOperations::SUBTRACTION:
                    $data = self::subtract($firstNumber, $secondNumber);
                    break;
                case CalculatorOperations::MULTIPLICATION:
                    $data = self::multiply($firstNumber, $secondNumber);
                    break;
                case CalculatorOperations::DIVISION:
                    $data = self::divide($firstNumber, $secondNumber);
                    break;
                case CalculatorOperations::SQUARE_ROOT:
                    $data = self::squareRoot($firstNumber);
                    break;
            }

            $result['data'] = $data;

            return $result;
        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();

            return $result;
        }
    }

    /**
     * Adds the two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float
     */
    public function add(float $firstNum, float $secondNum)
    {
        return $firstNum + $secondNum;
    }

    /**
     * Subtracts two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float
     */
    public function subtract(float $firstNum, float $secondNum)
    {
        return $firstNum - $secondNum;
    }

    /**
     * Multiplies two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float
     */
    public function multiply(float $firstNum, float $secondNum)
    {
        return $firstNum * $secondNum;
    }

    /**
     * Divides two given numbers.
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return float|string
     */
    public function divide(float $firstNum, float $secondNum)
    {
        if ($secondNum == 0) {
            throw new Exception(CalculatorErrorMessages::CANNOT_BE_DIVIDE_BY_ZERO);
        }

        return $firstNum / $secondNum;
    }

    /**
     * Square roots the given number
     *
     * @param float $firstNum
     *
     * @return float|string
     */
    public function squareRoot(float $firstNum)
    {
        if (!(new CalculatorValidator)->isValidSquareRootNum($firstNum)) {
            throw new Exception(CalculatorErrorMessages::CANNOT_SQUARE_NEGATIVE_NUMBER);
        }

        return sqrt($firstNum);
    }

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
}
