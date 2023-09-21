<?php

namespace Lordjoo\Apigee\Abstract;

use Lordjoo\Apigee\Apigee;

abstract class Service
{
    protected Apigee $client;

    public function __construct()
    {
        $this->client = app(Apigee::class);
    }
}
