<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\App;

/**
 * @template TApp of App
 * @extends EntityServiceInterface<TApp>
 * @extends EntityCrudServiceInterface<TApp>
 */
interface AppServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
