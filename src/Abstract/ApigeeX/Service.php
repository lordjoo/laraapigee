<?php

namespace Lordjoo\Apigee\Abstract\ApigeeX;

use Lordjoo\Apigee\Api\ApigeeX\ApigeeX;

abstract class Service
{
    protected ApigeeX $client;

    public function __construct()
    {
        $this->client = app(ApigeeX::class);
    }
}
