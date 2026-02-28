<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\ApiProductServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\ApiKeyValueMapServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\AppServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\DeveloperAppCredentialsServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\DeveloperAppServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\DeveloperServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\EnvironmentKeyValueMapServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\OrganizationKeyValueMapServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\ProxyServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\StatsServiceInterface;
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

    public function proxies(): ProxyServiceInterface
    {
        return new Services\ProxyService($this->httpClient, $this->config);
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

    public function developerApps(string $developerId): DeveloperAppServiceInterface
    {
        return new Services\DeveloperAppService($this->httpClient, $this->config, $developerId);
    }

    public function developerAppCredentials(string $developerId, string $appName): DeveloperAppCredentialsServiceInterface
    {
        return new Services\DeveloperAppCredentialService($this->httpClient, $this->config, $developerId, $appName);
    }

    public function stats(string $environment): StatsServiceInterface
    {
        return new Services\StatsService($this->httpClient, $this->config, $environment);
    }

    public function keyValueMaps(): OrganizationKeyValueMapServiceInterface
    {
        return new Services\OrganizationKeyValueMapService($this->httpClient, $this->config);
    }

    public function environmentKeyValueMaps(string $environment): EnvironmentKeyValueMapServiceInterface
    {
        return new Services\EnvironmentKeyValueMapService($this->httpClient, $this->config, $environment);
    }

    public function apiKeyValueMaps(string $apiProxy): ApiKeyValueMapServiceInterface
    {
        return new Services\ApiKeyValueMapService($this->httpClient, $this->config, $apiProxy);
    }
}
