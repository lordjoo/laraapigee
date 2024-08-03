<?php

namespace Lordjoo\LaraApigee\Utility\Serializers\Denormalizers;

use Carbon\Carbon;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DateDenormalizer implements DenormalizerInterface
{

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (null === $data || $data <= 1) {
            return null;
        }

        return Carbon::createFromTimestampMs($data);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Carbon::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            "*" => false,
            Carbon::class => true,
        ];
    }

}
