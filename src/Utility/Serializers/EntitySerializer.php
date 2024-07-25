<?php

namespace Lordjoo\LaraApigee\Utility\Serializers;

use ArrayObject;
use Exception;
use Lordjoo\LaraApigee\Utility\Serializers\Denormalizers\AppCredentialsPropertyDenormalizer;
use Lordjoo\LaraApigee\Utility\Serializers\Denormalizers\AttributesPropertyDenormalizer;
use Lordjoo\LaraApigee\Utility\Serializers\Denormalizers\DateDenormalizer;
use Lordjoo\LaraApigee\Utility\Serializers\Normalizers\AttributesPropertyNormalizer;
use Lordjoo\LaraApigee\Utility\Serializers\Normalizers\DateNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class EntitySerializer implements IEntitySerializer
{
    private Serializer $serializer;


    private string $format = JsonEncoder::FORMAT;

    /**
     * EntitySerializer constructor.
     *
     * @param NormalizerInterface[]|DenormalizerInterface[] $normalizers
     */
    public function __construct(array $normalizers = [])
    {
        $normalizers = array_merge($normalizers, [
                new DateDenormalizer(),
                new DateNormalizer(),

                new AttributesPropertyDenormalizer(),
                new AttributesPropertyNormalizer(),

                new ArrayDenormalizer(),
                new ObjectNormalizer(
                    null,
                    null,
                    null,
                    new ReflectionExtractor()
                ),
            ]
        );
        $this->serializer = new Serializer($normalizers, [$this->jsonEncoder()]);
    }

    public function denormalize($data, $type, $format = null, array $context = []): mixed
    {
        return $this->serializer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $this->format === $format && $this->serializer->supportsDenormalization($data, $type, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        return $this->serializer->normalize($object, $format, $context);
    }

    /**
     * {@inheritdoc}
     * @param mixed $data
     * @param null $format
     * @param array $context
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $this->format === $format && $this->serializer->supportsNormalization($data, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, $format, array $context = []): string
    {
        if (!$this->supportsEncoding($format)) {
            throw new Exception(sprintf('Serialization for the format %s is not supported. Only %s supported.', $format, $this->format));
        }

        return $this->serializer->serialize($data, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, $type, $format, array $context = []): mixed
    {
        if (!$this->supportsDecoding($format)) {
            throw new Exception(sprintf('Deserialization for the format %s is not supported. Only %s supported.', $format, $this->format));
        }

        $context['json_decode_associative'] = false;

        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function decode($data, $format, array $context = []): mixed
    {
        return $this->serializer->decode($data, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDecoding($format): bool
    {
        return $this->format === $format && $this->serializer->supportsDecoding($format);
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = []): string
    {
        return $this->serializer->encode($data, $format, $context = []);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format): bool
    {
        return $this->format === $format && $this->serializer->supportsEncoding($format);
    }


    public function getSupportedTypes(?string $format): array
    {
        return $this->serializer->getSupportedTypes($format);
    }

    public function jsonEncoder(): JsonEncoder
    {
        return new JsonEncoder(new JsonDecode());
    }

}
