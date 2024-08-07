<?php

namespace Lordjoo\LaraApigee\Api\Edge\Contracts;

use Lordjoo\LaraApigee\Contracts\Service\EntityCrudServiceInterface;
use Lordjoo\LaraApigee\Contracts\Service\EntityServiceInterface;

interface TargetServerServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
