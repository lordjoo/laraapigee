<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Serializer\NameConverter;

use Lordjoo\LaraApigee\Utility\Serializer\NameConverterBase;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class ApiPackageNameConverter extends NameConverterBase implements NameConverterInterface
{

    protected function getExternalToLocalMapping(): array
    {
        return [
            'product' => 'apiProducts',
        ];
    }

}
