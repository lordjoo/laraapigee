<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Utility\Serializer\Denormalizers;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\OperationGroup;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\OperationConfig;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class OperationGroupPropertyDenormalizer implements DenormalizerInterface, SerializerAwareInterface
{

    protected SerializerInterface $serializer;

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $type = new $type();

        $operations = $data['operationConfigs'] ?? [];
        $operationConfigType = $data['operationConfigType'] ?? null;
        $serializedOperations = [];

        foreach ($operations as $operation) {
            $serializedOperations[] = $this->serializer->denormalize($operation, OperationConfig::class);
        }


        $type->setOperationConfigs($serializedOperations);
        $type->setOperationConfigType($operationConfigType);

        return $type;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        if (str_ends_with($type, '[]')) {
            return false;
        }
        return OperationGroup::class === $type;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            OperationGroup::class => true,
        ];
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
}
