<?php

namespace App\Console\Commands;

use App\Enum\CalculatorErrorMessages;
use App\Enum\CalculatorOperations;
use App\Services\Calculator\Calculator;
use App\Services\Calculator\CalculatorValidator;
use Illuminate\Console\Command;

class CliCalculator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:calculator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Opens up the CLI calculator.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $calculator = new Calculator();
        $calculatorValidator = new CalculatorValidator();
        $validOperation = false;
        $validFirstNum = false;
        $validSecondNum = false;

        $this->info($calculator->init());

        while (!$validOperation) {
            $operation = $this->ask('Please pick an operation');

            if (empty($operation)) {
                $this->error(CalculatorErrorMessages::CANNOT_BE_EMPTY);
            }

            if ($calculator->isValidOperation($operation)) {
                $validOperation = true;
            } else {
                $this->error(CalculatorErrorMessages::invalidOperation());
            }
        }

        while (!$validFirstNum) {
            $firstNum = $this->ask('Input first number');

            if ($calculatorValidator->isNumber($firstNum)) {
                $validFirstNum = true;
            } else {
                $this->error(CalculatorErrorMessages::INVALID_INPUT);
            }
        }

        if ($operation == CalculatorOperations::SQUARE_ROOT) {
            $result = $calculator->calculate($operation, $firstNum);

            if (!$result['success']) {
                return $this->error($result['message']);
            }

            return $this->info($result['data']);
        }

        while (!$validSecondNum) {
            $secondNum = $this->ask('Input second number');

            if ($calculatorValidator->isNumber($secondNum)) {
                $validSecondNum = true;
            } else {
                $this->error(CalculatorErrorMessages::INVALID_INPUT);
            }
        }

        $result = $calculator->calculate($operation, $firstNum, $secondNum);

        if (!$result['success']) {
            return $this->error($result['message']);
        }

        return $this->info($result['data']);
    }
}
