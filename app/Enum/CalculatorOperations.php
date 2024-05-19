<?php

namespace App\Enum;

use ReflectionClass;

class CalculatorOperations
{
    const ADDITION = '+';
    const SUBTRACTION = '-';
    const MULTIPLICATION = '*';
    const DIVISION = '/';
    const SQUARE_ROOT = 'sqrt';

    /**
     * Gets all the value inside this class
     *
     * @return array
     */
    public static function all()
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
