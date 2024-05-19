<?php

namespace App\Services\Calculator\Operations;

use App\Enum\CalculatorErrorMessages;
use App\Services\Calculator\CalculatorValidator;
use App\Services\Calculator\Operations\OperationInterface;
use Exception;

class SquareRoot implements OperationInterface
{
    private $firstNum = 0;

    /**
     * Initialize the class
     *
     * @param float $firstNum
     *
     * @return void
     */
    public function __construct(float $firstNum)
    {
        $this->firstNum = $firstNum;
    }

    /**
     * @return float
     */
    public function compute()
    {
        if (!(new CalculatorValidator)->isValidSquareRootNum($this->firstNum)) {
            throw new Exception(CalculatorErrorMessages::CANNOT_SQUARE_NEGATIVE_NUMBER);
        }

        return sqrt($this->firstNum);
    }
}
