<?php

namespace Lordjoo\LaraApigee\Api\Edge;

use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\Authenticators\BasicAuth;
use Lordjoo\LaraApigee\HttpClient\HttpClient;

class Edge
{
    protected ConfigDriver $config;
    protected HttpClient $httpClient;

    public function __construct(ConfigDriver $config)
    {
        $this->config = $config;
        $authenticator = new BasicAuth(
            $this->config->getUsername(),
            $this->config->getPassword()
        );
        $this->httpClient = new HttpClient(
            $this->config->getEndpoint().'/organizations/'.$this->config->getOrganization().'/',
            $authenticator
        );
    }


    public function apiProducts(): Services\ApiProductService
    {
        return new Services\ApiProductService($this->httpClient,$this->config);
    }

    public function developers(): Services\DeveloperService
    {
        return new Services\DeveloperService($this->httpClient,$this->config);
    }

    public function apps(): Services\AppService
    {
        return new Services\AppService($this->httpClient,$this->config);
    }

    public function developerApps(string $email): Services\DeveloperAppService
    {
        return new Services\DeveloperAppService($this->httpClient,$this->config,$email);
    }

    public function developerAppCredentials(string $developerId, string $appName): Services\DeveloperAppCredentialsService
    {
        return new Services\DeveloperAppCredentialsService($this->httpClient,$this->config,$developerId,$appName);
    }

    public function companies(): Services\CompanyService
    {
        return new Services\CompanyService($this->httpClient,$this->config);
    }
}
