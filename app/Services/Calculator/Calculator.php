<?php

namespace App\Services\Calculator;

use App\Enum\CalculatorErrorMessages;
use App\Enum\CalculatorOperations;
use App\Services\Calculator\Operations\Add;
use App\Services\Calculator\Operations\Divide;
use App\Services\Calculator\Operations\Multiply;
use App\Services\Calculator\Operations\SquareRoot;
use App\Services\Calculator\Operations\Subtract;
use Exception;

class Calculator implements CalculatorInterface
{
    /**
     * Gives the instruction for using the calculator.
     *
     * @return string
     */
    public function instruction()
    {
        $message = "This is a CLI Calculator.\n";
        $message .= "You can add, subtract, multiply, divide, a given pair of numbers, or even square root a number. \n";
        $message .= "Here are the available operations: \n";
        $message .= "+ (for addition) \n";
        $message .= "- (for subtraction) \n";
        $message .= "* (for multiplication) \n";
        $message .= "/ (for division) \n";
        $message .= "sqrt (for square root) \n";

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

        try {
            switch ($operation) {
                case CalculatorOperations::ADDITION:
                    $data = (new Add($firstNumber, $secondNumber))->compute();
                    break;
                case CalculatorOperations::SUBTRACTION:
                    $data = (new Subtract($firstNumber, $secondNumber))->compute();
                    break;
                case CalculatorOperations::MULTIPLICATION:
                    $data = (new Multiply($firstNumber, $secondNumber))->compute();
                    break;
                case CalculatorOperations::DIVISION:
                    $data = (new Divide($firstNumber, $secondNumber))->compute();
                    break;
                case CalculatorOperations::SQUARE_ROOT:
                    $data = (new SquareRoot($firstNumber))->compute();
                    break;
                default:
                    throw new Exception(CalculatorErrorMessages::invalidOperation());
            }

            $result['data'] = $data;

            return $result;
        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();

            return $result;
        }
    }
}
