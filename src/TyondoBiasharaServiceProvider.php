<?php

namespace Tyondo\Biashara;

use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Tyondo\Biashara\Console\Commands\Install;
use Tyondo\Biashara\Console\Commands\Publish\Assets;
use Tyondo\Biashara\Console\Commands\Publish\Config;
use Tyondo\Biashara\Console\Commands\Publish\Migrations;
use Tyondo\Biashara\Console\Commands\Publish\Views;

class TyondoBiasharaServiceProvider extends ServiceProvider
{
    protected $defer = false;
    protected $publishableDir = __DIR__ . '/../Publishable';

    protected $providers = [
        'Tyondo\Mnara\MnaraServiceProvider'
    ];
    protected $aliases = [
        'TyondoBiashara'=> 'Tyondo\Biashara\TyondoBiashara',
        'Form' => 'Collective\Html\FormFacade',
        'Html' => 'Collective\Html\HtmlFacade'
    ];
    protected $commands = [
        Install::class,
        Views::class,
        Migrations::class,
        Assets::class,
        Config::class,
    ];
    /**
     * Configuration files.
     */
    private function registerConfigs()
    {
        $configPath = $this->publishableDir.'/Config/biashara.php';
        // Allows any modifications from the published config file to be seamlessly merged with default config file
        $this->mergeConfigFrom($configPath, 'biashara');
    }
    private function publishResources()
    {
        $publishable = [
            'public' => [
                "$this->publishableDir/Public/tyondo/biashara/" => public_path('vendor/tyondo/biashara'),
            ],
            'migrations' => [
                "$this->publishableDir/Database/migrations" => database_path('migrations'),
            ],
            'views' => [
                "$this->publishableDir/Resources/views/" => resource_path('views/vendor/biashara')
            ],
            'config' => [
                "$this->publishableDir/Config/biashara.php" => config_path('biashara.php'),
            ],
        ];
        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
    /**
     * Migration files.
     */
    private function handleMigrations()
    {
        // Load the migrations...
        $this->loadMigrationsFrom("$this->publishableDir/Database/migrations");
    }
    /**
     * Command files.
     */
    private function handleCommands()
    {
        // Register the commands...
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }
    /**
     * Register factory files.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerConfigs();
        $this->handleMigrations();
        $this->publishResources();
        $this->handleCommands();
        // Load the views...
        $this->loadViewsFrom($this->publishableDir.'/Resources/views', 'biashara');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $router = $this->app['router'];
        // Register factories...
        $this->registerEloquentFactoriesFrom($this->publishableDir.'Database/factories');
        // Register service providers...
        $this->registerServiceProviders();
        // Register facades...
        $this->registerAliases();
        // Register middleware...
        $this->app->singleton('biashara', function() {
            return new TyondoBiashara();
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
    /**
     * @return void
     */
    private function registerServiceProviders()
    {
        foreach ($this->providers as $provider)
        {
            $this->app->register($provider);
        }
    }
    /**
     * @return void
     */
    private function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->aliases as $key => $alias)
        {
            $loader->alias($key, $alias);
        }
    }
}
