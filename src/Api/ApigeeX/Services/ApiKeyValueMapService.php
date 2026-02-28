<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\ApiKeyValueMapServiceInterface;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class ApiKeyValueMapService extends AbstractKeyValueMapService implements ApiKeyValueMapServiceInterface
{
    protected string $apiProxy;

    public function __construct(HttpClient $httpClient, ConfigDriver $config, string $apiProxy)
    {
        parent::__construct($httpClient, $config);
        $this->apiProxy = $apiProxy;
    }

    protected function keyValueMapCollectionPath(): string
    {
        return (new URLTemplate('apis/{apiProxy}/keyvaluemaps'))
            ->bindParam('apiProxy', $this->apiProxy)
            ->getURL();
    }
}
