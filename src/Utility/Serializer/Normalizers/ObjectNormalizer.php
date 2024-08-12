<?php


namespace Lordjoo\LaraApigee\Utility\Serializer\Normalizers;

use ArrayObject;
use Lordjoo\LaraApigee\Utility\Serializer\JsonEncoder;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer as BaseObjectNormalizer;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ObjectNormalizer implements NormalizerInterface, SerializerAwareInterface
{

    protected ?BaseObjectNormalizer $objectNormalizer = null;


    protected ?SerializerInterface $serializer = null;

    /**
     * The API client only communicates in JSON with Apigee Edge.
     *
     * @var string
     */
    private string $format = JsonEncoder::FORMAT;

    /**
     * EntityNormalizer constructor.
     *
     * @param ClassMetadataFactoryInterface|null $classMetadataFactory
     * @param NameConverterInterface|null $nameConverter
     * @param PropertyAccessorInterface|null $propertyAccessor
     * @param PropertyTypeExtractorInterface|null $propertyTypeExtractor
     */
    public function __construct(ClassMetadataFactoryInterface $classMetadataFactory = null, NameConverterInterface $nameConverter = null, PropertyAccessorInterface $propertyAccessor = null, PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        if (null === $propertyTypeExtractor) {
            $reflectionExtractor = new ReflectionExtractor();

            $propertyTypeExtractor = new PropertyInfoExtractor(
                [
                    $reflectionExtractor,
                ],
                // Type extractors
                [
                    $reflectionExtractor,
                ]
            );
        }

        $this->objectNormalizer = new BaseObjectNormalizer($classMetadataFactory, $nameConverter, $propertyAccessor, $propertyTypeExtractor);
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-suppress InvalidReturnType stdClass is also an object.
     * @psalm-suppress PossiblyInvalidArgument First argument of array_filter is always an array.
     * @psalm-suppress PossiblyNullArgument First argument of array_filter is always an array.
     */
    public function normalize($object, $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        $asArray = $this->objectNormalizer->normalize($object, $this->format, $context);
        // Exclude null values from the output, even if PATCH is not supported on Apigee Edge
        // sending a smaller portion of data in POST/PUT is always a good practice.
        $asArray = array_filter($asArray, function ($value) {
            return !is_null($value);
        });
        ksort($asArray);

        return $this->convertToArrayObject($asArray);
    }

    /**
     * {@inheritdoc}
     * @param mixed $data
     * @param null $format
     * @param array $context
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        // Enforce the only supported format if format is null.
        $format = $format ?? $this->format;

        return $format === $this->format && $this->objectNormalizer->supportsNormalization($data, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
        $this->objectNormalizer->setSerializer($serializer);
    }

    /**
     * {@inheritDoc}
     */
    public function convertToArrayObject($normalized, $array_as_props = ArrayObject::ARRAY_AS_PROPS)
    {
        // default set ARRAY_AS_PROPS flag as we need entries to be accessed as properties.
        return new ArrayObject($normalized, $array_as_props);
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            '*' => false,
        ];
    }
}
