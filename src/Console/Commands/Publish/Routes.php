<?php

namespace Tyondo\Biashara\Console\Commands\Publish;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tyondo\Biashara\Console\Commands\BiasharaCommand;

class Routes extends BiasharaCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'biashara:publish:routes {--y|y : Skip question?} {--f|force : Overwrite existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Biashara routes';

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
        // Gather options...
        $publish = $this->option('y') ?: false;
        $force = $this->option('force') ?: false;

        if (! $publish) {
            $publish = $this->confirm('Publish Biashara routes?');
        }

        // Publish config...
        if ($publish) {

            $this->info('Adding Biashara routes to routes/web.php');
            File::append(
                base_path('routes/web.php'),
                "\n\nRoute::group(['prefix' => ''], function () {\n    TyondoBiashara::routes();\n});\n"
            );
            $this->progress(5);
            $this->line(PHP_EOL.'<info>✔</info> Success! Biashara routes successfully added.');
        }
    }
}
