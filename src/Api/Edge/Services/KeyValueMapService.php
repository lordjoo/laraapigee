<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\KeyValueMapServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\KeyValueMap;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\CrudOperationsTrait;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class KeyValueMapService extends BaseService implements KeyValueMapServiceInterface
{
    use CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected string $environment;

    public function __construct(
        HttpClient   $httpClient,
        ConfigDriver $config,
        string       $environment
    )
    {
        $this->environment = $environment;
        parent::__construct($httpClient, $config);
    }

    public function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('environments/{env}/keyvaluemaps/'))
            ->bindParam('env', $this->environment)
            ->appendPath($path);
    }


    public function getEntityClass(): string
    {
        return KeyValueMap::class;
    }
}
