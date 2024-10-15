<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Contracts;

use Lordjoo\LaraApigee\Contracts\Service\EntityCrudServiceInterface;
use Lordjoo\LaraApigee\Contracts\Service\EntityServiceInterface;

interface ApiProductServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
