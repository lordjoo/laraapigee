<?php

namespace Lordjoo\LaraApigee\Facades;

use Illuminate\Support\Facades\Facade;
use Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX;
use Lordjoo\LaraApigee\Api\Edge\Edge;

/**
 * @see \Lordjoo\LaraApigee\LaraApigee
 *
 * @method static Edge edge()
 * @method static ApigeeX apigeeX()
 * @method static Edge|ApigeeX platform(string $platform)
 */
class LaraApigee extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Lordjoo\LaraApigee\LaraApigee::class;
    }
}
