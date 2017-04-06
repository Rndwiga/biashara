<?php

namespace Tyondo\Biashara\Console\Commands;

use Illuminate\Console\Command;

class BiasharaCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function progress($tasks)
    {
        $bar = $this->output->createProgressBar($tasks);

        for ($i = 0; $i < $tasks; $i++) {
            time_nanosleep(0, 200000000);
            $bar->advance();
        }

        $bar->finish();
    }
    /*
     * Build on this class to include other functions to be run at installation or
     *  when other commands are running
     * */

}
