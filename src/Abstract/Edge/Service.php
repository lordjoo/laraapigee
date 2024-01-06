<?php

namespace Lordjoo\Apigee\Abstract\Edge;

use Lordjoo\Apigee\Apigee;
use Lordjoo\Apigee\Support\HttpClient;

abstract class Service
{
    protected HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }
}
