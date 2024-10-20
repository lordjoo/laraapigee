<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\Environment;
use Lordjoo\LaraApigee\Contracts\Services\EnvironmentServiceInterface;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\CrudOperationsTrait;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class EnvironmentService extends BaseService implements EnvironmentServiceInterface
{
    use EntityEndpointAwareTrait,
        EntityClassAwareTrait,
        CrudOperationsTrait;

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('environments/'))->appendPath($path);
    }

    public function getEntityClass(): string
    {
        return Environment::class;
    }
}
