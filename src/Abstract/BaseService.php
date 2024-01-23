<?php

namespace Lordjoo\Apigee\Abstract;

use Lordjoo\Apigee\Support\HttpClient;

abstract class BaseService
{
    protected HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }
}
