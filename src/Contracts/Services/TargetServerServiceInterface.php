<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\TargetServer;

/**
 * @template TTargetServer of TargetServer
 * @extends EntityServiceInterface<TTargetServer>
 * @extends EntityCrudServiceInterface<TTargetServer>
 */
interface TargetServerServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
