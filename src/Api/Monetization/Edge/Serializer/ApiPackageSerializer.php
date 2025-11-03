<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Denormalizers\ApiPackageDenormalizer;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Normalizers\ApiPackageNormalizer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;

class ApiPackageSerializer extends EntitySerializer
{
    public function __construct(array $normalizers = [])
    {
        $normalizers = array_merge($normalizers, [
            parent::getEntityTypeSpecificNormalizers(),
            new ApiPackageDenormalizer(),
            new ApiPackageNormalizer()
        ]);
        parent::__construct($normalizers);
    }
}
