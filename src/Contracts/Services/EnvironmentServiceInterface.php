<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\Environment;

/**
 * @template TEnvironment of Environment
 * @extends EntityServiceInterface<TEnvironment>
 * @extends EntityCrudServiceInterface<TEnvironment>
 */
interface EnvironmentServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
