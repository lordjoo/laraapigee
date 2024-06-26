<?php

namespace Lordjoo\LaraApigee\Utility\Serializers\Denormalizers;

use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AttributesPropertyDenormalizer implements DenormalizerInterface
{

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $flatten = [];
        foreach ($data as $key => $item) {
            if (is_object($item)) {
                // $data came from the EntityNormalizer.
                $flatten[$item->name] = $item->value ?? null;
            } else {
                $flatten[$key] = $item;
            }
        }
        $data = $flatten;

        return new $type($data);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        if (str_ends_with($type, '[]')) {
            return false;
        }
        return AttributesProperty::class === $type || $type instanceof AttributesProperty;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            AttributesProperty::class => true,
        ];
    }
}
