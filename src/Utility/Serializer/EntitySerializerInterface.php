<?php

namespace Lordjoo\LaraApigee\Utility\Serializer;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

interface EntitySerializerInterface extends NormalizerInterface, DenormalizerInterface, EncoderInterface, DecoderInterface, SerializerInterface
{
    public static function getEntityTypeSpecificNormalizers(): array;
}
