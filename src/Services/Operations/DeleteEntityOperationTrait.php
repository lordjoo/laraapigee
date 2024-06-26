<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;

trait DeleteEntityOperationTrait
{
    use ClientAwareTrait,
        EntitySerializerAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    public function delete($entityId): bool
    {
        $path = (string) $this->getEntityPath("/$entityId");
        $this->getClient()->delete($path);
        return true;
    }
}
