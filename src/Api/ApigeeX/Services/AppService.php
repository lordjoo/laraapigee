<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\App;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Contracts\Services\DeveloperAppServiceInterface;
use Lordjoo\LaraApigee\Entities\EntityInterface;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class AppService extends BaseService implements DeveloperAppServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    public function __construct(
        HttpClient   $httpClient,
        ConfigDriver $config
    )
    {
        parent::__construct($httpClient, $config);
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('apps/'))
            ->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return App::class;
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        throw new \BadMethodCallException('This operation is Not supported');
    }

    public function update(string $entityId, EntityInterface $entity): EntityInterface
    {
        throw new \BadMethodCallException('This operation is Not supported');
    }

    public function delete(string $identifier): bool
    {
        throw new \BadMethodCallException('This operation is Not supported');
    }

}
