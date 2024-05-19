<?php

namespace App\Services\Calculator\Operations;

interface OperationInterface
{
    /**
     * Computes the given number base on the operation
     */
    public function compute();
}
