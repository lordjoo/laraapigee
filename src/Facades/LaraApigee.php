<?php

namespace Lordjoo\LaraApigee\Facades;

use Illuminate\Support\Facades\Facade;
use Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX;
use Lordjoo\LaraApigee\Api\Edge\Edge;
use Lordjoo\LaraApigee\Api\Monetization\Monetization;

/**
 * @see \Lordjoo\LaraApigee\LaraApigee
 *
 * @method static Edge edge()
 * @method static ApigeeX apigeeX()
 * @method static Monetization monetization()
 * @method static Edge|ApigeeX platform(string $platform)
 */
class LaraApigee extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Lordjoo\LaraApigee\LaraApigee::class;
    }
}
