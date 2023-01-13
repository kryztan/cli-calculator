<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatorTest extends TestCase
{

    public function test_addition()
    {
        $this->artisan('calculator')
            ->expectsQuestion('Input', '5 + 2')
            ->expectsOutput('7')
            ->expectsQuestion('Input', '-120.11 + 51.5')
            ->expectsOutput('-68.61')
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_subtraction()
    {
        $this->artisan('calculator')
            ->expectsQuestion('Input', '31 - 16')
            ->expectsOutput('15')
            ->expectsQuestion('Input', '-32 - -16.87')
            ->expectsOutput('-15.13')
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_multiplication()
    {
        $this->artisan('calculator')
            ->expectsQuestion('Input', '9 * 8')
            ->expectsOutput('72')
            ->expectsQuestion('Input', '9.7 * -6.05')
            ->expectsOutput('-58.685')
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_division()
    {
        $this->artisan('calculator')
            ->expectsQuestion('Input', '24 / 8')
            ->expectsOutput('3')
            ->expectsQuestion('Input', '-16.8 / -2')
            ->expectsOutput('8.4')
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_square_root()
    {
        $this->artisan('calculator')
            ->expectsQuestion('Input', '144 sqrt')
            ->expectsOutput('12')
            ->expectsQuestion('Input', '282.24 sqrt')
            ->expectsOutput('16.8')
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_invalid_input()
    {
        $this->artisan('calculator')
            ->expectsQuestion('Input', 'invalid')
            ->expectsOutput('Invalid input!')
            ->expectsQuestion('Input', '')
            ->expectsOutput('Invalid input!')
            ->expectsQuestion('Input', 'qwerty123 + zxc987')
            ->expectsOutput('Invalid input!')
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_random_number_and_operation()
    {
        $num1 = rand(1, 100);
        $num2 = rand(1, 100);
        $operations = ['+', '-', '*', '/'];
        $operation = $operations[rand(0, 3)];

        $input = $num1." ".$operation." ".$num2;
        $output = null;

        switch ($operation) {
            case '+':
                $output =  $num1 + $num2;
                break;
            case '-':
                $output = $num1 - $num2;
                break;
            case '*':
                $output = $num1 * $num2;
                break;
            case '/':
                $output = $num1 / $num2;
                break;
        }

        $this->artisan('calculator')
            ->expectsQuestion('Input', $input)
            ->expectsOutput(strval($output))
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }

    public function test_random_square_root()
    {
        $num = rand(1, 100);
        $output = sqrt($num);

        $this->artisan('calculator')
            ->expectsQuestion('Input', $num." sqrt")
            ->expectsOutput(strval($output))
            ->expectsQuestion('Input', 'exit')
            ->assertSuccessful();
    }
}
