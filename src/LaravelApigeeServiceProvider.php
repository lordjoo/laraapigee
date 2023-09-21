<?php

namespace Lordjoo\Apigee;

use Lordjoo\Apigee\Exceptions\ErrorHandlerInterface;
use Lordjoo\Apigee\Exceptions\Handler;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelApigeeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-apigee')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $driver = config('apigee.driver');
        $client = Factory::fromDriver(new $driver());
        $this->app->bind('apigee', fn () => $client);
        $this->app->singleton(Apigee::class, fn () => $client);
        $this->app->alias(Apigee::class, 'apigee');
        $this->app->bind(ErrorHandlerInterface::class, Handler::class);
    }
}
