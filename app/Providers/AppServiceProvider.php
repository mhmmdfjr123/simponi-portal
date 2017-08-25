<?php

namespace App\Providers;

use App\Services\Encryption\RsaService;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

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
        $this->registerLocalization();

        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->singleton(RsaService::class, RsaService::class);
    }

    private function registerLocalization() {
        $localeRegion = config('app.locale'); // Example => en_US
        $lang = \Locale::getPrimaryLanguage($localeRegion); // Example => en

        setlocale(LC_ALL, $localeRegion);
        Carbon::setLocale($lang);

        $this->app->singleton(Formatter::class, function () {
            return new FormatterService(config('app.locale'));
        });
    }
}
