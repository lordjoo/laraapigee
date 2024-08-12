<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Serializer\Normalizers;

use Lordjoo\LaraApigee\Api\Monetization\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Serializer\NameConverter\ApiPackageNameConverter;
use Lordjoo\LaraApigee\Utility\Serializer\Normalizers\ObjectNormalizer;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class ApiPackageNormalizer extends ObjectNormalizer
{
    public function __construct(?ClassMetadataFactoryInterface $classMetadataFactory = null, ?NameConverterInterface $nameConverter = null, ?PropertyAccessorInterface $propertyAccessor = null, ?PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        $nameConverter = $nameConverter ?? new ApiPackageNameConverter();
        parent::__construct($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor);
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|\ArrayObject    |array|string|null
    {
        $normalized = parent::normalize($object, $format, $context);
        foreach ($normalized['product'] as $id => $data) {
            $normalized['product'][$id] = ['id' => $data['id'] ?? $data['name']];
        }

        return $normalized;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof ApiPackage;
    }
}
