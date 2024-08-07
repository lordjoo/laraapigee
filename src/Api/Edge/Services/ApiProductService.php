<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\ApiProductServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\ApiProduct;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class ApiProductService extends BaseService implements ApiProductServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('apiproducts/'))->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return ApiProduct::class;
    }
}
