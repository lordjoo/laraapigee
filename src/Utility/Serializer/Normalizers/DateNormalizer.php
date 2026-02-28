<?php

namespace Lordjoo\LaraApigee\Utility\Serializer\Normalizers;

use Carbon\Carbon;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DateNormalizer implements NormalizerInterface
{

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        if (!$object instanceof Carbon) {
            throw new InvalidArgumentException('The object must be an instance of Carbon');
        }
        return $object->getTimestampMs();
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Carbon;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            "*" => false,
            Carbon::class => true,
        ];
    }

}
