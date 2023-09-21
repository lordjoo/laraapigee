<?php

namespace Lordjoo\Apigee\Api\Edge;

use Illuminate\Http\Client\PendingRequest;
use Lordjoo\Apigee\Apigee;

class ApigeeEdge
{
    protected ?PendingRequest $httpClient;

    public function __construct()
    {
        $this->httpClient = app(Apigee::class)->httpClient();
    }

    public function environments()
    {
        return $this->httpClient->get('environments')->json();
    }

    public function apiProxy(): Services\ApiProxyService
    {
        return new \Lordjoo\Apigee\Api\Edge\Services\ApiProxyService();
    }

    public function apiProduct(): Services\ApiProductService
    {
        return new \Lordjoo\Apigee\Api\Edge\Services\ApiProductService();
    }

    public function developer(): Services\DeveloperService
    {
        return new \Lordjoo\Apigee\Api\Edge\Services\DeveloperService();
    }

    public function company(): Services\CompanyService
    {
        return new \Lordjoo\Apigee\Api\Edge\Services\CompanyService();
    }

    public function developerApp(string $developerEmail): Services\DeveloperAppService
    {
        return new \Lordjoo\Apigee\Api\Edge\Services\DeveloperAppService($developerEmail);
    }

    public function companyApp(string $companyName): Services\CompanyAppService
    {
        return new \Lordjoo\Apigee\Api\Edge\Services\CompanyAppService($companyName);
    }

    //    public function monetization(): Edge\Monetization\Monetization
    //    {
    //        return new Edge\Monetization\Monetization(->endpoint, ->username, ->password, ->organization);
    //    }

}
