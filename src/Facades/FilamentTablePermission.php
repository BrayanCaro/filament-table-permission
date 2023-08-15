<?php

namespace BrayanCaro\FilamentTablePermission\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BrayanCaro\FilamentTablePermission\FilamentTablePermission
 */
class FilamentTablePermission extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BrayanCaro\FilamentTablePermission\FilamentTablePermission::class;
    }
}
