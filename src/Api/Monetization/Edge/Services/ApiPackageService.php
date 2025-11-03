<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Denormalizers\ApiPackageDenormalizer;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Normalizers\ApiPackageNormalizer;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\CrudOperationsTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class ApiPackageService extends BaseService implements ApiPackageServiceInterface
{
    use CrudOperationsTrait,
        EntityClassAwareTrait,
        EntityEndpointAwareTrait;

    public function getEntityClass(): string
    {
        return ApiPackage::class;
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('monetization-packages/'))->appendPath($path);
    }

    public function getSerializer(): EntitySerializerInterface
    {
        return new EntitySerializer([
            new ApiPackageDenormalizer(),
            new ApiPackageNormalizer(),
        ]);
    }
}
