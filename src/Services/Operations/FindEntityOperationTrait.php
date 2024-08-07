<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\IEntity;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;

trait FindEntityOperationTrait
{
    use ClientAwareTrait,
        EntitySerializerAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * @param $entityId
     * @return IEntity|null
     */
    public function find($entityId): ?IEntity
    {
        $path = (string) $this->getEntityPath("/$entityId");
        $response = $this->getClient()->get($path);
        return $this->getSerializer()->denormalize(json_decode($response->getBody()->getContents(), true), $this->getEntityClass());
    }
}
