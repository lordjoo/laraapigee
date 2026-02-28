<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

/**
 * @template TEntity of \Lordjoo\LaraApigee\Entities\EntityInterface
 * @extends EntityCreateOperationInterface<TEntity>
 * @extends EntityReadOperationInterface<TEntity>
 * @extends EntityUpdateOperationInterface<TEntity>
 * @extends EntityDeleteOperationInterface
 * @extends EntityFindOperationInterface<TEntity>
 */
interface EntityCrudServiceInterface extends
    EntityCreateOperationInterface,
    EntityReadOperationInterface,
    EntityUpdateOperationInterface,
    EntityDeleteOperationInterface,
    EntityFindOperationInterface
{

}
