<?php namespace App\Support\Facades;

use App\Contracts\PortalGuard;
use Illuminate\Support\Facades\Facade;

/**
 * to handle get instance of PortalGuard from Laravel IoC Container
 *
 * @author efriandika
 *
 * @see \App\Services\PortalSessionGuardService
 * @see \App\Contracts\PortalGuard
 */
class PortalAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PortalGuard::class;
    }
}
