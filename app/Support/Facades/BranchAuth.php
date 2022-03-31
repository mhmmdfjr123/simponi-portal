<?php namespace App\Support\Facades;

use App\Contracts\BranchGuard;
use Illuminate\Support\Facades\Facade;

/**
 * to handle get instance of BranchGuard from Laravel IoC Container
 *
 * @author efriandika
 *
 * @see \App\Services\PortalSessionGuardService
 * @see \App\Contracts\PortalGuard
 */
class BranchAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BranchGuard::class;
    }
}
