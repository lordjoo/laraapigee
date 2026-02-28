<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Entities\EntityInterface;

/**
 * @template TEntity of EntityInterface
 */
interface EntityCreateOperationInterface
{

    /**
     * Create a new entity
     *
     * @param TEntity $entity
     * @return TEntity
     *
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function create(EntityInterface $entity): EntityInterface;
}
