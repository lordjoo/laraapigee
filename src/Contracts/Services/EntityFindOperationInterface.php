<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Entities\EntityInterface;

/**
 * @template TEntity of EntityInterface
 */
interface EntityFindOperationInterface
{
    /**
     * @return TEntity|null
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function find($entityId): ?EntityInterface;


}
