<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\AddonsServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\DeveloperBalanceServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\DeveloperMonetizationConfigServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\DeveloperSubscriptionServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\RatePlanServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services\AddonsService;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services\DeveloperBalanceService;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services\DeveloperMonetizationConfigService;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services\DeveloperSubscriptionService;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services\RatePlanService;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\Authenticators\Oauth;
use Lordjoo\LaraApigee\HttpClient\HttpClient;

class Monetization
{
    protected ConfigDriver $config;

    protected HttpClient $httpClient;

    public function __construct(ConfigDriver $config)
    {
        $this->config = $config;

        $keyFilePath = $this->config->getKeyFile();
        if (!is_readable($keyFilePath)) {
            throw new \RuntimeException('Apigee X monetization requires an accessible service account key file.');
        }

        $keyFile = json_decode(file_get_contents($keyFilePath), true);
        if (!is_array($keyFile) || !isset($keyFile['client_email'], $keyFile['private_key'])) {
            throw new \RuntimeException('Invalid service account key file provided for Apigee X monetization.');
        }
        $authenticator = new Oauth($keyFile['client_email'], $keyFile['private_key']);

        $endpoint = rtrim($this->config->getMonetizationEndpoint() ?: $this->config->getEndpoint(), '/');
        if (!preg_match('#/v\d+$#', $endpoint)) {
            $endpoint .= '/v1';
        }

        $this->httpClient = new HttpClient($endpoint . '/', $authenticator);
    }

    public function ratePlans(string $apiProduct): RatePlanServiceInterface
    {
        return new RatePlanService($this->httpClient, $this->config, $apiProduct);
    }

    public function developerSubscriptions(string $developerEmail): DeveloperSubscriptionServiceInterface
    {
        return new DeveloperSubscriptionService($this->httpClient, $this->config, $developerEmail);
    }

    public function developerBalance(string $developerEmail): DeveloperBalanceServiceInterface
    {
        return new DeveloperBalanceService($this->httpClient, $this->config, $developerEmail);
    }

    public function developerMonetizationConfig(string $developerEmail): DeveloperMonetizationConfigServiceInterface
    {
        return new DeveloperMonetizationConfigService($this->httpClient, $this->config, $developerEmail);
    }

    public function addons(): AddonsServiceInterface
    {
        return new AddonsService($this->httpClient, $this->config);
    }
}
