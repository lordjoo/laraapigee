<?php

namespace Lordjoo\Apigee;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\Api\ApigeeX\ApigeeX;
use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;
use Lordjoo\Apigee\Support\MakesHttpRequests;

/**
 * Class Apigee
 *
 * @method static Apigee init()
 */
class Apigee
{

    public function __construct() {}

    public function edge(): Api\Edge\ApigeeEdge
    {
        return new Api\Edge\ApigeeEdge();
    }

    public function x(): ApigeeX
    {
       return new ApigeeX();
    }

}
