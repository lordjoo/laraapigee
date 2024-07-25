<?php

namespace Lordjoo\LaraApigee\Utility\Serializers\Normalizers;

use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AttributesPropertyNormalizer implements NormalizerInterface
{

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $return = [];
        foreach ($object->values() as $key => $value) {
            $return[] =  ['name' => $key, 'value' => $value];
        }

        return $return;
    }


    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof AttributesProperty;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            AttributesProperty::class => true,
        ];
    }
}
