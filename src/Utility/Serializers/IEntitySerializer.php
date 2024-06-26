<?php

namespace Lordjoo\LaraApigee\Utility\Serializers;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

interface IEntitySerializer extends NormalizerInterface, DenormalizerInterface, EncoderInterface, DecoderInterface, SerializerInterface
{

}
