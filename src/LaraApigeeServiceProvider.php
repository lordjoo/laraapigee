<?php

namespace Lordjoo\LaraApigee;

use Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX;
use Lordjoo\LaraApigee\Api\Edge\Edge;
use Lordjoo\LaraApigee\Utility\Serializers\EntitySerializer;
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

        $normalizers = config('laraapigee.normalizers', []);
        $this->app->singleton(
            EntitySerializer::class,
            fn () => new EntitySerializer($normalizers)
        );

        $this->app->singleton(
            Edge::class,
            fn () => new Edge($this->app->make(ConfigReaders\ConfigDriver::class))
        );

        $this->app->singleton(
            ApigeeX::class,
            fn () => new ApigeeX($this->app->make(ConfigReaders\ConfigDriver::class))
        );

        $this->app->singleton(LaraApigee::class, fn () => new LaraApigee());
        $this->app->alias(LaraApigee::class, 'lara-apigee');
    }

}
