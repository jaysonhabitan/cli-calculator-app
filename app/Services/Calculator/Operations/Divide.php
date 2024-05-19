<?php

namespace App\Services\Calculator\Operations;

use App\Enum\CalculatorErrorMessages;
use App\Services\Calculator\Operations\OperationInterface;
use Exception;

class Divide implements OperationInterface
{
    private $firstNum = 0;
    private $secondNum = 0;

    /**
     * Initialize the class
     *
     * @param float $firstNum
     * @param float $secondNum
     *
     * @return void
     */
    public function __construct(float $firstNum, float $secondNum)
    {
        $this->firstNum = $firstNum;
        $this->secondNum = $secondNum;
    }

    /**
     * @return float
     */
    public function compute()
    {
        if ($this->secondNum == 0) {
            throw new Exception(CalculatorErrorMessages::CANNOT_BE_DIVIDE_BY_ZERO);
        }

        return $this->firstNum / $this->secondNum;
    }
}
