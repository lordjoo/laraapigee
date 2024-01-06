<?php

namespace Lordjoo\Apigee\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lordjoo\Apigee\Apigee
 *
 * @method static \Lordjoo\Apigee\Api\Edge\ApigeeEdge edge()
 * @method static \Lordjoo\Apigee\Api\ApigeeX\ApigeeX x()
 */
class Apigee extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apigee';
    }
}
