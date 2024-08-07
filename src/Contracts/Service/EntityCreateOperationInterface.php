<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

use Lordjoo\LaraApigee\Entities\IEntity;

interface EntityCreateOperationInterface
{

    /**
     * Create a new entity
     *
     * @param IEntity $entity
     * @return IEntity
     *
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function create(IEntity $entity): IEntity;
}
