<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Way\Generators\GeneratorsServiceProvider;
use Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Boot helper
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(GeneratorsServiceProvider::class);
            $this->app->register(MigrationsGeneratorServiceProvider::class);
        }
    }
}
