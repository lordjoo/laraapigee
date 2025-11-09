<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Services;

use Lordjoo\LaraApigee\Api\Monetization\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Serializer\Denormalizers\ApiPackageDenormalizer;
use Lordjoo\LaraApigee\Api\Monetization\Serializer\NameConverter\ApiPackageNameConverter;
use Lordjoo\LaraApigee\Api\Monetization\Serializer\Normalizers\ApiPackageNormalizer;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\CrudOperationsTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
            new ApiPackageNormalizer()
        ]);
    }



}

