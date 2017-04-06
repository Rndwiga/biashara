<?php

namespace Tyondo\Biashara\Console\Commands\Publish;

use Illuminate\Support\Facades\Artisan;
use Tyondo\Biashara\Console\Commands\BiasharaCommand;

class Assets extends BiasharaCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'biashara:publish:assets {--y|y : Skip question?} {--f|force : Overwrite existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Tyondo\'s Biashara public assets';

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
     * @return mixed
     */
    public function handle()
    {
        // Gather arguments...
        $publish = $this->option('y') ?: false;
        $force = $this->option('force') ?: false;

        if (! $publish) {
            $publish = $this->confirm('Publish Biashara core public assets?');
        }

        // Publish assets...
        if ($publish) {
            $exitCode = Artisan::call('vendor:publish', [
                '--provider' => 'Tyondo\Biashara\TyondoBiasharaServiceProvider',
                '--tag' => 'public',
                '--force' => $force,
            ]);
            $this->progress(5);
            $this->line(PHP_EOL.'<info>✔</info> Success! Biashara core public assets have been published.');
        }
    }
}
