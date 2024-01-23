<?php

namespace Lordjoo\Apigee\Facades;

use Illuminate\Support\Facades\Facade;
use Lordjoo\Apigee\Api\Edge\Services\ProductService;

/**
 * @see \Lordjoo\Apigee\Apigee
 *
 * @method static ProductService|ProductService product()
 */
class Apigee extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Lordjoo\Apigee\Apigee::class;
    }
}
