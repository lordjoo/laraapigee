<?php

namespace Lordjoo\Apigee\Api\Edge;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Lordjoo\Apigee\Api\Edge\Monetization\Monetization;
use Lordjoo\Apigee\Api\Edge\Services\ApiProductService;
use Lordjoo\Apigee\Api\Edge\Services\ApiProxyService;
use Lordjoo\Apigee\Api\Edge\Services\CompanyAppService;
use Lordjoo\Apigee\Api\Edge\Services\CompanyService;
use Lordjoo\Apigee\Api\Edge\Services\DeveloperAppService;
use Lordjoo\Apigee\Api\Edge\Services\DeveloperService;
use Lordjoo\Apigee\Apigee;

class ApigeeEdge
{
    protected ?PendingRequest $httpClient;
    protected mixed $monetizationEnabled;

    public function __construct()
    {
        $this->httpClient = app(Apigee::class)->httpClient();
        $this->monetizationEnabled = app(Apigee::class)->isMonetization;
    }

    public function environments()
    {
        return $this->httpClient->get('environments')->json();
    }

    public function apiProxy(): Services\ApiProxyService
    {
        return new ApiProxyService();
    }

    public function apiProduct(): Services\ApiProductService
    {
        return new ApiProductService();
    }

    public function developer(): Services\DeveloperService
    {
        return new DeveloperService();
    }

    public function company(): Services\CompanyService
    {
        return new CompanyService();
    }

    public function developerApp(string $developerEmail): Services\DeveloperAppService
    {
        return new DeveloperAppService($developerEmail);
    }

    public function companyApp(string $companyName): Services\CompanyAppService
    {
        return new CompanyAppService($companyName);
    }

    public function monetization(): Monetization
    {
        if (!$this->monetizationEnabled)
            throw new Exception('Monetization is not enabled in configuration');
        return new Monetization();
    }

}
