<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

use Lordjoo\LaraApigee\Entities\EntityInterface;

interface EntityUpdateOperationInterface
{
    /**
     * Update an entity.
     *
     * @param string $entityId
     * @param EntityInterface $entity
     * @return EntityInterface
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function update(string $entityId, EntityInterface $entity): EntityInterface;
}
