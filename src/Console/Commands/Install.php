<?php

namespace Tyondo\Biashara\Console\Commands;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class Install extends BiasharaCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'biashara:install {--y|y : Skip question?} {--views : Also publish biashara views.} {--f|force : Overwrite existing files.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tyondo Biashara Package install wizard';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * If the aggregator_installed.lock file is found in the storage/ directory
     * the installer will not execute.
     *
     * @return mixed
     */
    public function handle()
    {
            // Gather the options...
            $force = $this->option('force') ?: false;
            $withViews = $this->option('views') ?: false;

            $this->comment(PHP_EOL.'Welcome to the Tyondo Biashara Install Wizard! You\'ll be up and running in no time...');

            // Attempt to link storage/app/public folder to public/storage;
            // This won't work on an OS without symlink support (e.g. Windows)
            try {
                Artisan::call('storage:link');
            } catch (Exception $e) {
                $this->line(PHP_EOL.'Could not link <info>storage/app/public</info> folder to <info>public/storage</info>:');
                $this->line("<error>✘</error> {$e->getMessage()}");
            }


            try {
                // Publish config files...
                Artisan::call('biashara:publish:config', [
                    '--y' => true,
                    '--force' => true,
                ]);
                // Publish migration files...
                Artisan::call('biashara:publish:migrations', [
                    '--y' => true,
                    '--force' => true,
                ]);

                // Publish public assets...
                Artisan::call('biashara:publish:assets', [
                    '--y' => true,
                    '--force' => true,
                ]);
                // Publish view files...
                if ($withViews) {
                    Artisan::call('biashara:publish:views', [
                        '--y' => true,
                        '--force' => $force,
                    ]);
                }

                // Set up the database...
               // if (! (SetupHelper::requiredTablesExists())) {
                    $this->comment(PHP_EOL.'Setting up your database...');
                    $exitCode = Artisan::call('migrate', [
                        //'--path' => realpath(__DIR__.'/../Database/migrations'),
                    ]);
                    $exitCode = Artisan::call('db:seed', [
                        '--class' => 'Tyondo\Biashara\Database\seeds\DatabaseSeeder',
                    ]);
                    $this->progress(5);
                    $this->line(PHP_EOL.'<info>✔</info> Success! Your database is set up and configured.');
               // }

                $this->info('Adding Biashara routes to routes/web.php');
                File::append(
                    base_path('routes/web.php'),
                    "\n\nRoute::group(['prefix' => ''], function () {\n    TyondoBiashara::routes();\n});\n"
                );


                // Clear the caches...
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
                Artisan::call('route:clear');

                $this->line(PHP_EOL.'<info>✔</info> You have successfully install Tyondo\'s Biashara package :-)'.PHP_EOL);

                $this->line(PHP_EOL);

            } catch (Exception $e) {
                // Rollback migrations
                // Artisan::call('migrate:rollback');
                // Remove install file
                //$this->uninstalled();
                // Display message
                $this->line(PHP_EOL.'<error>An unexpected error occurred. Installation could not continue.</error>');
                $this->error("✘ {$e->getMessage()}");
                $this->comment(PHP_EOL.'Please run the installer again.');
                $this->line(PHP_EOL.'If this error persists please consult https://github.com/Rndwiga/biashara.'.PHP_EOL);
            }
    }
}
