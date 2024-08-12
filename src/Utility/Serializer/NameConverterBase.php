<?php

namespace Lordjoo\LaraApigee\Utility\Serializer;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

abstract class NameConverterBase implements NameConverterInterface
{

    public function normalize($propertyName): string
    {
        if ($externalPropertyName = array_search($propertyName, $this->getExternalToLocalMapping())) {
            return $externalPropertyName;
        }

        return $propertyName;
    }


    public function denormalize($propertyName): string
    {
        if (array_key_exists($propertyName, $this->getExternalToLocalMapping())) {
            return $this->getExternalToLocalMapping()[$propertyName];
        }

        return $propertyName;
    }

    abstract protected function getExternalToLocalMapping(): array;
}
