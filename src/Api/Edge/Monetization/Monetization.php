<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\Api\Edge\Monetization\Services\ApiPackageService;
use Lordjoo\Apigee\Api\Edge\Monetization\Services\DeveloperService;
use Lordjoo\Apigee\Api\Edge\Monetization\Services\OrganizationService;
use Lordjoo\Apigee\Support\MakesHttpRequests;

class Monetization
{
    use MakesHttpRequests;

    protected string $endpoint;
    protected string $username;
    protected string $password;
    protected string $organization;

    protected ?PendingRequest $httpClient = null;

    public function __construct() {
        $configDriver = config('apigee.driver');
        $config = new $configDriver();
        $this->endpoint = $config->getMonetizationEndpoint();
        $this->username = $config->getUserName();
        $this->password = $config->getPassword();
        $this->organization = $config->getOrganization();
        $this->httpClient = $this->httpClient();
    }

    public function httpClient(): PendingRequest
    {
        return $this->httpClient ??= Http::baseUrl($this->endpoint.'/mint/organizations/'.$this->organization.'/')
            ->withBasicAuth($this->username, $this->password);
    }

    public function organization(): OrganizationService
    {
        return new OrganizationService($this);
    }

    public function apiPackage(): ApiPackageService
    {
        return new ApiPackageService($this);
    }

    public function developer(): DeveloperService
    {
        return new DeveloperService($this);
    }
}
