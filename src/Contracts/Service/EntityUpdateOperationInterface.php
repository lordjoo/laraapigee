<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

use Lordjoo\LaraApigee\Entities\IEntity;

interface EntityUpdateOperationInterface
{
    /**
     * Update an entity.
     *
     * @param string $entityId
     * @param IEntity $entity
     * @return IEntity
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function update(string $entityId, IEntity $entity): IEntity;
}
