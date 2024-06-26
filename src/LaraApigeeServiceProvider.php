<?php

namespace Lordjoo\LaraApigee;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Lordjoo\LaraApigee\Commands\LaraApigeeCommand;

class LaraApigeeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laraapigee')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        $driver = config('laraapigee.driver');
        $this->app->bind(ConfigReaders\ConfigDriver::class, $driver);
        $this->app->singleton(LaraApigee::class, fn () => new LaraApigee());
        $this->app->alias(LaraApigee::class, 'lara-apigee');
    }

}
