<?php

namespace Lordjoo\LaraApigee\Services;

use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;

trait EntitySerializerAwareTrait
{
    abstract public function getSerializer(): EntitySerializerInterface;
}
