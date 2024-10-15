<?php

namespace Lordjoo\LaraApigee\Utility\Serializer\Denormalizers;

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
            }
            if (is_array($item) && isset($item['name']) && isset($item['value'])) {
                $flatten[$item['name']] = $item['value'];
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
        return AttributesProperty::class === $type;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            AttributesProperty::class => true,
        ];
    }
}
