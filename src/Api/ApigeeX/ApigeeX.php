<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX;

use Lordjoo\LaraApigee\Api\ApigeeX\Services\DeveloperAppService;
use Lordjoo\LaraApigee\Api\ApigeeX\Services\DeveloperService;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\Authenticators\Oauth;
use Lordjoo\LaraApigee\HttpClient\HttpClient;

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
        $this->httpClient = new HttpClient($config->getEndpoint(), $authenticator);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function developers(): DeveloperService
    {
        return new DeveloperService($this->httpClient, $this->config);
    }

    public function developerApps(string $developerId): DeveloperAppService
    {
        return new DeveloperAppService($this->httpClient, $this->config, $developerId);
    }


}
