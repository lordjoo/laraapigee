<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\EntityInterface;
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
     * @return EntityInterface|null
     */
    public function find($entityId): ?EntityInterface
    {
        $path = (string) $this->getEntityPath("/$entityId");
        $response = $this->getClient()->get($path);
        return $this->getSerializer()->denormalize(json_decode($response->getBody()->getContents(), true), $this->getEntityClass());
    }
}
