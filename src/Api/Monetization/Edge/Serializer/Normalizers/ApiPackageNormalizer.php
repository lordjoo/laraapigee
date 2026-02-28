<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Normalizers;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\NameConverter\ApiPackageNameConverter;
use Lordjoo\LaraApigee\Utility\Serializer\Normalizers\ObjectNormalizer;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class ApiPackageNormalizer extends ObjectNormalizer
{
    public function __construct(?ClassMetadataFactoryInterface $classMetadataFactory = null, ?NameConverterInterface $nameConverter = null, ?PropertyAccessorInterface $propertyAccessor = null, ?PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        $nameConverter = $nameConverter ?? new ApiPackageNameConverter;
        parent::__construct($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor);
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        $normalized = parent::normalize($object, $format, $context);
        if (! isset($normalized['product']) || ! is_iterable($normalized['product'])) {
            return $normalized;
        }

        foreach ($normalized['product'] as $id => $data) {
            if (is_array($data)) {
                $normalized['product'][$id] = ['id' => $data['id'] ?? $data['name'] ?? null];
            }
        }

        return $normalized;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof ApiPackage;
    }
}
