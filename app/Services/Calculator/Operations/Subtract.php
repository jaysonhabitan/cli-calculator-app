<?php

namespace App\Services\Calculator\Operations;

use App\Services\Calculator\Operations\OperationInterface;

class Subtract implements OperationInterface
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
        return $this->firstNum - $this->secondNum;
    }
}
