<?php

namespace Visanduma\LaravelLiteSubscription\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Visanduma\LaravelLiteSubscription\LaravelLiteSubscription
 */
class LaravelLiteSubscription extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-lite-subscription';
    }
}
