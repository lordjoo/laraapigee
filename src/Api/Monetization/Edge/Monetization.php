<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiProductServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\BillingAdjustmentServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\CreditServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\DeveloperServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\RatePlanServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\RefundServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ReportServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ApiPackageService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ApiProductService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\BillingAdjustmentService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\CreditService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\DeveloperService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\RatePlanService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\RefundService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ReportService;
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
        if (! str_contains($baseEndpoint, '/mint')) {
            $baseEndpoint .= '/mint';
        }

        if (! str_ends_with($baseEndpoint, '/organizations')) {
            $baseEndpoint .= '/organizations';
        }

        $this->httpClient = new HttpClient(
            $baseEndpoint.'/'.$this->config->getOrganization().'/',
            $authenticator
        );
    }

    public function apiPackages(): ApiPackageServiceInterface
    {
        return new ApiPackageService($this->httpClient, $this->config);
    }

    public function apiProducts(): ApiProductServiceInterface
    {
        return new ApiProductService($this->httpClient, $this->config);
    }

    public function billingAdjustments(): BillingAdjustmentServiceInterface
    {
        return new BillingAdjustmentService($this->httpClient, $this->config);
    }

    public function credits(): CreditServiceInterface
    {
        return new CreditService($this->httpClient, $this->config);
    }

    public function developers(): DeveloperServiceInterface
    {
        return new DeveloperService($this->httpClient, $this->config);
    }

    public function ratePlans(): RatePlanServiceInterface
    {
        return new RatePlanService($this->httpClient, $this->config);
    }

    public function refunds(): RefundServiceInterface
    {
        return new RefundService($this->httpClient, $this->config);
    }

    public function reports(): ReportServiceInterface
    {
        return new ReportService($this->httpClient, $this->config);
    }
}
