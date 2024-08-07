<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

interface EntityCrudServiceInterface extends
    EntityCreateOperationInterface,
    EntityReadOperationInterface,
    EntityUpdateOperationInterface,
    EntityDeleteOperationInterface
{

}
