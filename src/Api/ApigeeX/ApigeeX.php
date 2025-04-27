<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX;

use Lordjoo\LaraApigee\Contracts;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\Authenticators\Oauth;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Api\ApigeeX\Services;

class ApigeeX
{
    protected ConfigDriver $config;
    protected HttpClient $httpClient;

    public function __construct(
        ConfigDriver $config
    ) {
        $this->config = $config;
        $keyFile = file_get_contents($this->config->getKeyFile());
        $keyFile = json_decode($keyFile, true);
        $authenticator = new Oauth($keyFile['client_email'], $keyFile['private_key']);
        $this->httpClient = new HttpClient(
            $config->getEndpoint().'/organizations/'.$config->getOrganization().'/',
            $authenticator);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function apiProducts(): Contracts\Services\ApiProductServiceInterface
    {
        return new Services\ApiProductService($this->httpClient, $this->config);
    }

    public function developers(): Contracts\Services\DeveloperServiceInterface
    {
        return new Services\DeveloperService($this->httpClient, $this->config);
    }

    public function developerApps(string $developerId): Contracts\Services\DeveloperAppServiceInterface
    {
        return new Services\DeveloperAppService($this->httpClient, $this->config, $developerId);
    }




}
