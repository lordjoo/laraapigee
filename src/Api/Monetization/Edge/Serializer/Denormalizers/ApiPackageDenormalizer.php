<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Denormalizers;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiProduct;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\NameConverter\ApiPackageNameConverter;
use Lordjoo\LaraApigee\Utility\Serializer\Denormalizers\ObjectDenormalizer;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class ApiPackageDenormalizer extends ObjectDenormalizer
{
    public function __construct(?ClassMetadataFactoryInterface $classMetadataFactory = null, ?NameConverterInterface $nameConverter = null, ?PropertyAccessorInterface $propertyAccessor = null, ?PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        $nameConverter = $nameConverter ?? new ApiPackageNameConverter;
        parent::__construct($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor);
    }

    public function denormalize($data, $type, $format = null, array $context = []): mixed
    {
        /** @var ApiPackage $data */
        $data = parent::denormalize($data, $type, $format, $context);

        $apiProducts = array_map(function ($apiProduct) {
            return $this->serializer->denormalize($apiProduct, ApiProduct::class);
        }, $data->getApiProducts());

        $data->setApiProducts($apiProducts);

        return $data;
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        if (str_ends_with($type, '[]')) {
            return false;
        }

        return $type === ApiPackage::class;
    }
}
