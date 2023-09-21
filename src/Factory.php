<?php

namespace Lordjoo\Apigee;

use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;

class Factory
{
    public static function fromConfig(): Apigee
    {
        return new Apigee(
            config('apigee.endpoint'),
            config('apigee.username'),
            config('apigee.password'),
            config('apigee.organization')
        );
    }

    public static function fromDriver(ConfigReaderInterface $driver): Apigee
    {
        return new Apigee(
            $driver->getEndpoint(),
            $driver->getUserName(),
            $driver->getPassword(),
            $driver->getOrganization()
        );
    }
}
