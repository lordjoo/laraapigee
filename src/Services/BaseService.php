<?php

namespace Lordjoo\LaraApigee\Services;

use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Utility\Serializers\EntitySerializer;

abstract class BaseService
{
    protected HttpClient $httpClient;

    protected ConfigDriver $config;

    public function __construct(
        HttpClient $httpClient,
        ConfigDriver $config
    ) {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    /**
     * @return HttpClient
     */
    protected function getClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * @return EntitySerializer
     */
    protected function getSerializer(): EntitySerializer
    {
        return new EntitySerializer();
    }

}
