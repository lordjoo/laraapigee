<?php

namespace Lordjoo\LaraApigee\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lordjoo\LaraApigee\LaraApigee
 *
 * @method static \Lordjoo\LaraApigee\Api\Edge\Edge edge()
 * @method static \Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX apigeeX()
 */
class LaraApigee extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'lara-apigee';
    }
}
