<?php

namespace Lordjoo\LaraApigee\Api\Edge;

use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\Authenticators\BasicAuth;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Contracts;

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
            $this->config->getEndpoint() . '/organizations/' . $this->config->getOrganization() . '/',
            $authenticator
        );
    }


    public function apiProducts(): Contracts\Services\ApiProductServiceInterface
    {
        return new Services\ApiProductService($this->httpClient, $this->config);
    }

    public function developers(): Contracts\Services\DeveloperServiceInterface
    {
        return new Services\DeveloperService($this->httpClient, $this->config);
    }

    public function apps(): Contracts\Services\AppServiceInterface
    {
        return new Services\AppService($this->httpClient, $this->config);
    }

    public function developerApps(string $email): Contracts\Services\DeveloperAppServiceInterface
    {
        return new Services\DeveloperAppService($this->httpClient, $this->config, $email);
    }

    public function developerAppCredentials(string $developerId, string $appName): Contracts\Services\DeveloperAppCredentialsServiceInterface
    {
        return new Services\DeveloperAppCredentialsService($this->httpClient, $this->config, $developerId, $appName);
    }

    public function companies(): Contracts\Services\CompanyServiceInterface
    {
        return new Services\CompanyService($this->httpClient, $this->config);
    }

    public function targetServers(string $environment): Contracts\Services\TargetServerServiceInterface
    {
        return new Services\TargetServerService($this->httpClient, $this->config, $environment);
    }

    public function environments(): Contracts\Services\EnvironmentServiceInterface
    {
        return new Services\EnvironmentService($this->httpClient, $this->config);
    }
}
