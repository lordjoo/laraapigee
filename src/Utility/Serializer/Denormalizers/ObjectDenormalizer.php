<?php


namespace Lordjoo\LaraApigee\Utility\Serializer\Denormalizers;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer as BaseObjectNormalizer;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * Object normalizer decorator that can denormalize an object to a valid
 * payload for Apigee Edge.
 */
class ObjectDenormalizer implements DenormalizerInterface, SerializerAwareInterface
{

    protected BaseObjectNormalizer $objectNormalizer;

    protected SerializerInterface $serializer;

    private string $format = JsonEncoder::FORMAT;

    /**
     * EntityDenormalizer constructor.
     *
     * @param ClassMetadataFactoryInterface|null $classMetadataFactory
     * @param NameConverterInterface|null $nameConverter
     * @param PropertyAccessorInterface|null $propertyAccessor
     * @param PropertyTypeExtractorInterface|null $propertyTypeExtractor
     */
    public function __construct(?ClassMetadataFactoryInterface $classMetadataFactory = null, ?NameConverterInterface $nameConverter = null, ?PropertyAccessorInterface $propertyAccessor = null, ?PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        if (null === $propertyTypeExtractor) {
            $reflectionExtractor = new ReflectionExtractor();
            $phpDocExtractor = new PhpDocExtractor();

            $propertyTypeExtractor = new PropertyInfoExtractor(
                [
                    $reflectionExtractor,
                ],
                // Type extractors
                [
                    $phpDocExtractor,
                    $reflectionExtractor,
                ]
            );
        }

        if (null === $propertyAccessor) {
            // BaseObjectNormalizer would do the same.
            $propertyAccessor = PropertyAccess::createPropertyAccessor();
        }

        $this->objectNormalizer = new BaseObjectNormalizer($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor);
    }

    public function denormalize($data, $type, $format = null, array $context = []): mixed
    {
        // The original input should not be altered.
        if (is_object($data)) {
            $cleanData = clone $data;
        } else {
            $cleanData = $data;
        }
        // Exclude empty arrays from the denormalization process since
        // we are using variable-length arguments in entity setters instead
        // of arrays.

        foreach ($cleanData as $key => $value) {
            if (is_array($value) && empty($value)) {
                unset($cleanData->{$key});
            }
        }

        return $this->objectNormalizer->denormalize($cleanData, $type, $this->format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        if (str_ends_with($type, '[]')) {
            return false;
        }

        // Enforce the only supported format if format is null.
        $format = $format ?? $this->format;

        return $format === $this->format && $this->objectNormalizer->supportsDenormalization($data, $type, $format);
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
        $this->objectNormalizer->setSerializer($this->serializer);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            '*' => false,
        ];
    }
}
