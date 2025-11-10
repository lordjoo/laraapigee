<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ApiPackageService;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\Authenticators\BasicAuth;
use Lordjoo\LaraApigee\HttpClient\HttpClient;

class Monetization
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

        $baseEndpoint = rtrim($this->config->getMonetizationEndpoint() ?: $this->config->getEndpoint(), '/');
        if (!str_ends_with($baseEndpoint, '/organizations')) {
            $baseEndpoint .= '/organizations';
        }

        $this->httpClient = new HttpClient(
            $baseEndpoint . '/' . $this->config->getOrganization() . '/',
            $authenticator
        );
    }

    public function apiPackages(): ApiPackageServiceInterface
    {
        return new ApiPackageService($this->httpClient, $this->config);
    }
}
