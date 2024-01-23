<?php

namespace Lordjoo\Apigee;

use Lordjoo\Apigee\Api\ApigeeX\ApigeeX;
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

    public function packageBooted()
    {
        $driver = config('apigee.driver');
        $this->app->bind(ConfigReaders\ConfigReaderInterface::class, $driver);
        $client = Factory::fromDriver(new $driver());
        $this->app->singleton(Apigee::class, fn () => $client);
        $this->app->bind(ErrorHandlerInterface::class, Handler::class);
    }

}
