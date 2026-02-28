<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\EnvironmentKeyValueMapServiceInterface;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class EnvironmentKeyValueMapService extends AbstractKeyValueMapService implements EnvironmentKeyValueMapServiceInterface
{
    protected string $environment;

    public function __construct(HttpClient $httpClient, ConfigDriver $config, string $environment)
    {
        parent::__construct($httpClient, $config);
        $this->environment = $environment;
    }

    protected function keyValueMapCollectionPath(): string
    {
        return (new URLTemplate('environments/{environment}/keyvaluemaps'))
            ->bindParam('environment', $this->environment)
            ->getURL();
    }
}
