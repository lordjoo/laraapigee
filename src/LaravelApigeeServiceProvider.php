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

    public function packageRegistered()
    {
        $driver = config('apigee.driver');
        $client = Factory::fromDriver(new $driver());
        $this->app->singleton(Apigee::class, fn () => $client);
        $this->app->bind(ConfigReaders\ConfigReaderInterface::class, $driver);
        $this->app->singleton(Api\Edge\ApigeeEdge::class, fn () => $client->edge());
        $this->app->singleton(Api\ApigeeX\ApigeeX::class, fn () => $client->x());
        $this->app->bind(ErrorHandlerInterface::class, Handler::class);


    }
}
