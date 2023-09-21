<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization\Services;

use Lordjoo\Apigee\Api\Edge\Monetization\Monetization;

abstract class Service
{
    protected Monetization $client;

    public function __construct(Monetization $client)
    {
        $this->client = $client;
    }
}
