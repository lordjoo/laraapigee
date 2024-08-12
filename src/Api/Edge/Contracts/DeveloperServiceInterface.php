<?php

namespace Lordjoo\LaraApigee\Api\Edge\Contracts;

use Lordjoo\LaraApigee\Api\Edge\Entities\Developer;
use Lordjoo\LaraApigee\Contracts\Service\EntityCrudServiceInterface;
use Lordjoo\LaraApigee\Contracts\Service\EntityServiceInterface;
use Lordjoo\LaraApigee\Entities\EntityInterface;

interface DeveloperServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
