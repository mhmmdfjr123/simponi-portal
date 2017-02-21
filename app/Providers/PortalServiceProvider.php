<?php namespace App\Providers;

use App\Contracts\PortalGuard;
use App\Services\ApiClient\PortalApiClientService;
use App\Services\PortalSessionGuardService;
use Illuminate\Support\ServiceProvider;

/**
 * This class provides services that is needed by portal
 *
 * @package App\Providers
 * @author efriandika
 */
class PortalServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->registerApiClient();
        $this->registerAuthenticator();
    }

	/**
	 * Register the api client services for portal.
	 *
	 * @return void
	 */
	protected function registerApiClient()
	{
		$this->app->singleton(PortalApiClientService::class, PortalApiClientService::class);
	}

	/**
	 * Register the authenticator services for portal.
	 *
	 * @return void
	 */
	protected function registerAuthenticator()
	{
		$this->app->singleton(PortalGuard::class, PortalSessionGuardService::class);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [PortalApiClientService::class, PortalGuard::class];
	}
}
