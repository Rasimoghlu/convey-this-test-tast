<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class RunUnitTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:unit {filter?} {--without-tty : Disable TTY mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the project unit tests with Pest framework';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running Unit Tests with Pest...');
        
        $filter = $this->argument('filter');
        $withoutTty = $this->option('without-tty');
        
        $command = ['./vendor/bin/pest', '--testdox'];
        
        if ($filter) {
            $command[] = '--filter';
            $command[] = $filter;
        }
        
        $process = new Process($command);
        
        if (!$withoutTty && Process::isTtySupported()) {
            $process->setTty(true);
        }
        
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });
        
        $this->newLine();
        
        if ($process->isSuccessful()) {
            $this->info('All tests completed successfully!');
            return Command::SUCCESS;
        } else {
            $this->error('Some tests failed!');
            return Command::FAILURE;
        }
    }
}
