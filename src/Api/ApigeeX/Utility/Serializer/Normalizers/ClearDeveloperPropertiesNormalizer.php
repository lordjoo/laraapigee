<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Utility\Serializer\Normalizers;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Developer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ClearDeveloperPropertiesNormalizer implements NormalizerInterface
{
    public function normalize(
        mixed $object,
        ?string $format = null,
        array $context = []
    ): array|string|int|float|bool|\ArrayObject|null {
        $array = $object->toArray();

        // `originalEmail` is an internal Edge helper field and is rejected by Apigee X.
        unset($array['originalEmail']);

        return $array;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Developer;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Developer::class => true,
        ];
    }
}

