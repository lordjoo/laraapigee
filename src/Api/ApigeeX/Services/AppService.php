<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\AppServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\App;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Entities\EntityInterface;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class AppService extends BaseService implements AppServiceInterface
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

    /**
     * @throws \BadMethodCallException
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        throw new \BadMethodCallException('This operation is Not supported');
    }

    /**
     * @throws \BadMethodCallException
     */
    public function update(string $entityId, EntityInterface $entity): EntityInterface
    {
        throw new \BadMethodCallException('This operation is Not supported');
    }

    /**
     * @throws \BadMethodCallException
     */
    public function delete(string $entityId): bool
    {
        throw new \BadMethodCallException('This operation is Not supported');
    }

}
