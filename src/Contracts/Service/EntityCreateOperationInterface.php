<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

use Lordjoo\LaraApigee\Entities\EntityInterface;

interface EntityCreateOperationInterface
{

    /**
     * Create a new entity
     *
     * @param EntityInterface $entity
     * @return EntityInterface
     *
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function create(EntityInterface $entity): EntityInterface;
}
