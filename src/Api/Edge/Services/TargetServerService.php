<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\TargetServerServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\TargetServer;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\CrudOperationsTrait;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class TargetServerService extends BaseService implements TargetServerServiceInterface
{
    use CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected string $environment;

    public function __construct(
        HttpClient $httpClient,
        ConfigDriver $config,
        string $environment
    )
    {
        $this->environment = $environment;
        parent::__construct($httpClient, $config);
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('environments/{env}/targetservers'))
            ->bindParam('env', $this->environment)
            ->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return TargetServer::class;
    }


}
