<?php

namespace Lordjoo\LaraApigee\Api\Edge;

use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\ApiProductServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\AppServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\CompanyServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\DeveloperAppCredentialsServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\DeveloperAppServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\DeveloperServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\EnvironmentServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\TargetServerServiceInterface;
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
            $this->config->getEndpoint() . '/organizations/' . $this->config->getOrganization() . '/',
            $authenticator
        );
    }


    public function apiProducts(): ApiProductServiceInterface
    {
        return new Services\ApiProductService($this->httpClient, $this->config);
    }

    public function developers(): DeveloperServiceInterface
    {
        return new Services\DeveloperService($this->httpClient, $this->config);
    }

    public function apps(): AppServiceInterface
    {
        return new Services\AppService($this->httpClient, $this->config);
    }

    public function developerApps(string $email): DeveloperAppServiceInterface
    {
        return new Services\DeveloperAppService($this->httpClient, $this->config, $email);
    }

    public function developerAppCredentials(string $developerId, string $appName): DeveloperAppCredentialsServiceInterface
    {
        return new Services\DeveloperAppCredentialsService($this->httpClient, $this->config, $developerId, $appName);
    }

    public function companies(): CompanyServiceInterface
    {
        return new Services\CompanyService($this->httpClient, $this->config);
    }

    public function targetServers(string $environment): TargetServerServiceInterface
    {
        return new Services\TargetServerService($this->httpClient, $this->config, $environment);
    }

    public function environments(): EnvironmentServiceInterface
    {
        return new Services\EnvironmentService($this->httpClient, $this->config);
    }
}
