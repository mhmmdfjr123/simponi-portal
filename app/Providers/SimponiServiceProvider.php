<?php namespace App\Providers;

use App\Contracts\BranchGuard;
use App\Contracts\PortalGuard;
use App\Services\ApiClient\BranchApiClientService;
use App\Services\ApiClient\PortalApiClientService;
use App\Services\BranchSessionGuardService;
use App\Services\Encryption\SimponiRsaService;
use App\Services\PortalSessionGuardService;
use Illuminate\Support\ServiceProvider;

/**
 * This class provides services that is needed by portal
 *
 * @package App\Providers
 * @author efriandika
 */
class SimponiServiceProvider extends ServiceProvider
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
		$this->app->singleton(BranchApiClientService::class, BranchApiClientService::class);
		$this->app->singleton(PortalApiClientService::class, PortalApiClientService::class);
        $this->app->singleton(SimponiRsaService::class, SimponiRsaService::class);
	}

	/**
	 * Register the authenticator services for portal.
	 *
	 * @return void
	 */
	protected function registerAuthenticator()
	{
		$this->app->singleton(BranchGuard::class, BranchSessionGuardService::class);
		$this->app->singleton(PortalGuard::class, PortalSessionGuardService::class);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [PortalApiClientService::class, PortalGuard::class, BranchApiClientService::class, BranchGuard::class];
	}
}
