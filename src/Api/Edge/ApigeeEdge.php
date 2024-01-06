<?php

namespace Lordjoo\Apigee\Api\Edge;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\Api\Edge\Monetization\Monetization;
use Lordjoo\Apigee\Api\Edge\Services\ApiProductService;
use Lordjoo\Apigee\Api\Edge\Services\ApiProxyService;
use Lordjoo\Apigee\Api\Edge\Services\CompanyAppService;
use Lordjoo\Apigee\Api\Edge\Services\CompanyService;
use Lordjoo\Apigee\Api\Edge\Services\DeveloperAppService;
use Lordjoo\Apigee\Api\Edge\Services\DeveloperService;
use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;
use Lordjoo\Apigee\Support\HttpClient;

/**
 * Class ApigeeEdge
 *
 * @method static ApigeeEdge init()
 */
class ApigeeEdge
{

    protected ?PendingRequest $httpClient;
    protected mixed $monetizationEnabled;
    protected ConfigReaderInterface $driver;
    protected HttpClient $client;

    public function __construct()
    {
        $this->driver = app(ConfigReaderInterface::class);
        $this->monetizationEnabled = $this->driver->getMonetizationEnabled();
        $this->client = new HttpClient($this->initHttpClient());
        $this->httpClient = $this->client->httpClient;
    }

    public function environments()
    {
        return $this->httpClient->get('environments')->json();
    }

    public function apiProxy(): Services\ApiProxyService
    {
        return new ApiProxyService($this->client);
    }

    public function apiProduct(): Services\ApiProductService
    {
        return new ApiProductService($this->client);
    }

    public function developer(): Services\DeveloperService
    {
        return new DeveloperService($this->client);
    }

    public function company(): Services\CompanyService
    {
        return new CompanyService($this->client);
    }

    public function developerApp(string $developerEmail): Services\DeveloperAppService
    {
        return new DeveloperAppService($this->client, $developerEmail);
    }

    public function companyApp(string $companyName): Services\CompanyAppService
    {
        return new CompanyAppService($this->client, $companyName);
    }

    public function monetization(): Monetization
    {
        if (!$this->monetizationEnabled)
            throw new Exception('Monetization is not enabled in configuration');
        return new Monetization();
    }

    private function initHttpClient(): PendingRequest
    {
        $baseUrl = $this->driver->getEndpoint();
        $baseUrl .= '/organizations/' . $this->driver->getOrganization();
        return Http::baseUrl($baseUrl)
            ->withBasicAuth($this->driver->getUsername(), $this->driver->getPassword());
    }

}
