<?php

namespace Lordjoo\Apigee;

use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;

class Factory
{
    public static function fromConfig(): Apigee
    {
        return new Apigee();
    }

    public static function fromDriver(ConfigReaderInterface $driver): Apigee
    {
        return new Apigee();
    }
}
