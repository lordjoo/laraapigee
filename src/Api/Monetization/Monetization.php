<?php

namespace Lordjoo\LaraApigee\Api\Monetization;

use Lordjoo\LaraApigee\Api\Monetization\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Services\ApiPackageService;
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
        $this->httpClient = new HttpClient(
            $this->config->getMonetizationEndpoint().'/organizations/'.$this->config->getOrganization().'/',
            $authenticator
        );
    }


    public function apiPackages(): ApiPackageServiceInterface
    {
        return new ApiPackageService($this->httpClient, $this->config);
    }


}
