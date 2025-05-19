<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Entities\EntityInterface;

interface EntityFindOperationInterface
{
    /**
     * @return EntityInterface
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function find($entityId): ?EntityInterface;


}
