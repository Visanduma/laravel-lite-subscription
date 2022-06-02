<?php

namespace Visanduma\LaravelLiteSubscription;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Visanduma\LaravelLiteSubscription\Commands\LaravelLiteSubscriptionCommand;

class LaravelLiteSubscriptionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-lite-subscription')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-lite-subscription_table')
            ->hasCommand(LaravelLiteSubscriptionCommand::class);
    }
}
