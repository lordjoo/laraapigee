<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

interface EntityCrudServiceInterface extends
    EntityCreateOperationInterface,
    EntityReadOperationInterface,
    EntityUpdateOperationInterface,
    EntityDeleteOperationInterface
{

}
