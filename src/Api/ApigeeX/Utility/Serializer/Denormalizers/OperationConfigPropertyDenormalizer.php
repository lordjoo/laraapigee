<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Utility\Serializer\Denormalizers;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\OperationConfig;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\Operation;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\Quota;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class OperationConfigPropertyDenormalizer implements DenormalizerInterface, SerializerAwareInterface
{

    protected SerializerInterface $serializer;

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $operations = $data['operations'] ?? [];

        $serializedOperations = [];
        foreach ($operations as $operation) {
            $serializedOperations[] = $this->serializer->denormalize($operation, Operation::class);
        }

        $data['operations'] = $serializedOperations;

        if (count($data['quota']) == 0) {
            unset($data['quota']);
        } else {
            $data['quota'] = $this->serializer->denormalize($data['quota'], Quota::class);
        }
        return new $type($data);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        if (str_ends_with($type, '[]')) {
            return false;
        }
        return OperationConfig::class === $type;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            OperationConfig::class => true,
        ];
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
}
