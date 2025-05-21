<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Utility\Serializer\Normalizers;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\DeveloperApp;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ClearAppPropertiesNormalizer implements NormalizerInterface
{

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $ignore = [
            'description',
            'displayName',
        ];
        $array = $object->toArray();
        if (isset($array['initialApiProducts']) &&
            is_array($array['initialApiProducts']) &&
            count($array['initialApiProducts']) > 0
        ) $ignore[] = 'initialApiProducts';

        return array_diff_key($array, array_flip($ignore));
    }


    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof DeveloperApp;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            DeveloperApp::class => true,
        ];
    }
}
