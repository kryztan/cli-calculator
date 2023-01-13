<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Calculator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculator that performs basic operations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true) {
            $input = $this->ask('Input');

            if ($input === "exit") {
                break;
            }

            if (preg_match('/^(\-?\d+\.?\d*)\s*([\+\-\*\/])\s*(\-?\d+\.?\d*)$|^(\-?\d+\.?\d*)\s*(sqrt)$/', $input, $matches)) {

                if (isset($matches[4]) && isset($matches[5])) {
                    // sqrt operation match
                    Log::info(sqrt($matches[4]));
                    $this->info(sqrt($matches[4]));
                } else {
                    $num1 = $matches[1]; // 1st number
                    $num2 = $matches[3]; // 2nd number
                    switch ($matches[2]) { // operation
                        case '+':
                            $this->info(floatval($num1) + floatval($num2));
                            break;
                        case '-':
                            $this->info($num1 - $num2);
                            break;
                        case '*':
                            $this->info($num1 * $num2);
                            break;
                        case '/':
                            $this->info($num1 / $num2);
                            break;
                    }
                }

            } else {
                $this->error('Invalid input!');
            }
        }

        return CommandAlias::SUCCESS;
    }
}
