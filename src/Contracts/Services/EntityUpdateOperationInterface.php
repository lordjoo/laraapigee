<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Entities\EntityInterface;

/**
 * @template TEntity of EntityInterface
 */
interface EntityUpdateOperationInterface
{
    /**
     * Update an entity.
     *
     * @param string $entityId
     * @param TEntity $entity
     * @return TEntity
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function update(string $entityId, EntityInterface $entity): EntityInterface;
}
