<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\ApiProductServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\ApiProduct;
use Lordjoo\LaraApigee\Api\ApigeeX\Utility\Serializer\Denormalizers\OperationConfigPropertyDenormalizer;
use Lordjoo\LaraApigee\Api\ApigeeX\Utility\Serializer\Denormalizers\OperationGroupPropertyDenormalizer;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;


class ApiProductService extends BaseService implements ApiProductServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('apiproducts'))->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return ApiProduct::class;
    }


    /**
     * @return EntitySerializer
     */
    protected function getSerializer(): EntitySerializerInterface
    {
        return new EntitySerializer([
            new OperationConfigPropertyDenormalizer(),
            new OperationGroupPropertyDenormalizer(),
        ]);
    }
}
