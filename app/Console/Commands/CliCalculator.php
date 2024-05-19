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
     * @var Calculator
     */
    protected $calculator;

    /**
     * @var CalculatorValidator
     */
    protected $calculatorValidator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Calculator $calculator, CalculatorValidator $calculatorValidator)
    {
        parent::__construct();
        $this->calculator = $calculator;
        $this->calculatorValidator = $calculatorValidator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->calculator->instruction());

        $operation = $this->getValidInput('Please input an operation', function ($input) {
            return $this->calculatorValidator->isValidOperation($input);
        }, CalculatorErrorMessages::invalidOperation());

        $firstNum = $this->getValidInput('Input first number', function ($input) {
            return $this->calculatorValidator->isNumber($input);
        }, CalculatorErrorMessages::INVALID_INPUT);

        if ($operation == CalculatorOperations::SQUARE_ROOT) {
            $result = $this->calculator->calculate($operation, $firstNum);

            if (!$result['success']) {
                return $this->error($result['message']);
            }

            return $this->info($result['data']);
        }

        $secondNum = $this->getValidInput('Input second number', function ($input) {
            return $this->calculatorValidator->isNumber($input);
        }, CalculatorErrorMessages::INVALID_INPUT);

        $result = $this->calculator->calculate($operation, $firstNum, $secondNum);

        if (!$result['success']) {
            return $this->error($result['message']);
        }

        return $this->info($result['data']);
    }

    /**
     * Get valid input from the user.
     *
     * @param string $prompt
     * @param callable $validationCallback
     * @param string $errorMessage
     *
     * @return mixed
     */
    private function getValidInput(string $prompt, callable $validationCallback, string $errorMessage)
    {
        while (true) {
            $input = $this->ask($prompt);

            if (empty($input)) {
                $this->error(CalculatorErrorMessages::CANNOT_BE_EMPTY);
                continue;
            }

            if ($validationCallback($input)) {
                return $input;
            } else {
                $this->error($errorMessage);
            }
        }
    }
}
