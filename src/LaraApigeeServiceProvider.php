<?php

namespace Lordjoo\LaraApigee;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX;
use Lordjoo\LaraApigee\Api\Edge\Edge;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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

        $this->app->singleton(
            Edge::class,
            fn() => new Edge($this->app->make(ConfigReaders\ConfigDriver::class))
        );

        $this->app->singleton(
            ApigeeX::class,
            fn() => new ApigeeX($this->app->make(ConfigReaders\ConfigDriver::class))
        );

        $this->app->singleton(LaraApigee::class, fn() => new LaraApigee($this->app->make(ConfigReaders\ConfigDriver::class)));
        $this->app->alias(LaraApigee::class, 'lara-apigee');


        // todo: added to docs `whereApigeeAttribute(...)` method to Collection
        Collection::macro('whereApigeeAttribute', function (string $attribute, $op = null, mixed $value = null){
            $value = $value ?: $op;

            return $this->filter(function ($item) use ($attribute, $op, $value) {
                if ($item->attributes->get($attribute) === null) {
                    return false;
                }

                return match ($op) {
                    '!=' => $item->attributes->get($attribute) != $value,
                    '>' => $item->attributes->get($attribute) > $value,
                    '<' => $item->attributes->get($attribute) < $value,
                    '>=' => $item->attributes->get($attribute) >= $value,
                    '<=' => $item->attributes->get($attribute) <= $value,
                    default => $item->attributes->get($attribute) == $value,
                };

            });
        });

    }

}
