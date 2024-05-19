<?php

namespace Tests\Unit\Services\Calculator;

use App\Services\Calculator\Calculator;
use App\Enum\CalculatorOperations;
use App\Enum\CalculatorErrorMessages;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    protected $calculator;

    public function setUp(): void
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }

    /** @test */
    public function test_returns_correct_instruction()
    {
        $expected = "This is a CLI Calculator.\n";
        $expected .= "You can add, subtract, multiply, divide, a given pair of numbers, or even square root a number. \n";
        $expected .= "Here are the available operations: \n";
        $expected .= "1. + (for addition) \n";
        $expected .= "2. - (for subtraction) \n";
        $expected .= "3. * (for multiplication) \n";
        $expected .= "4. / (for division) \n";
        $expected .= "5. sqrt (for square root) \n";

        $this->assertEquals($expected, $this->calculator->init());
    }

    /** @test */
    public function test_can_add_numbers()
    {
        $result = $this->calculator->calculate(CalculatorOperations::ADDITION, 5, 3);
        $this->assertEquals(8, $result['data']);
    }

    /** @test */
    public function test_can_subtract_numbers()
    {
        $result = $this->calculator->calculate(CalculatorOperations::SUBTRACTION, 5, 3);
        $this->assertEquals(2, $result['data']);
    }

    /** @test */
    public function test_can_multiply_numbers()
    {
        $result = $this->calculator->calculate(CalculatorOperations::MULTIPLICATION, 5, 3);
        $this->assertEquals(15, $result['data']);
    }

    /** @test */
    public function test_can_divide_numbers()
    {
        $result = $this->calculator->calculate(CalculatorOperations::DIVISION, 6, 3);
        $this->assertEquals(2, $result['data']);
    }

    /** @test */
    public function test_throws_exception_when_dividing_by_zero()
    {
        $result = $this->calculator->calculate(CalculatorOperations::DIVISION, 5, 0);
        $this->assertEquals($result['message'], CalculatorErrorMessages::CANNOT_BE_DIVIDE_BY_ZERO);
    }

    /** @test */
    public function test_can_calculate_square_root()
    {
        $result = $this->calculator->calculate(CalculatorOperations::SQUARE_ROOT, 9);
        $this->assertEquals(3, $result['data']);
    }

    /** @test */
    public function test_throws_exception_when_square_root_of_negative_number()
    {
        $result = $this->calculator->calculate(CalculatorOperations::SQUARE_ROOT, -9);
        $this->assertEquals($result['message'], CalculatorErrorMessages::CANNOT_SQUARE_NEGATIVE_NUMBER);
    }

    /** @test */
    public function test_validates_operation()
    {
        $operations = CalculatorOperations::all();

        foreach ($operations as $operation) {
            $this->assertTrue($this->calculator->isValidOperation($operation));
        }

        $this->assertFalse($this->calculator->isValidOperation('xyz'));
    }

    /** @test */
    public function test_throws_exception_when_operation_is_incorrect()
    {
        $result = $this->calculator->calculate('abc', 5, 5);
        $this->assertEquals($result['message'], CalculatorErrorMessages::invalidOperation());
    }
}
