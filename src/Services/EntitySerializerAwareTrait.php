<?php

namespace Lordjoo\LaraApigee\Services;

use Lordjoo\LaraApigee\Utility\Serializers\IEntitySerializer;

trait EntitySerializerAwareTrait
{
    abstract public function getSerializer(): IEntitySerializer;
}
