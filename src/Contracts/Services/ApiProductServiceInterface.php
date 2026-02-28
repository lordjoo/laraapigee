<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\ApiProduct;

/**
 * @template TApiProduct of ApiProduct
 * @extends EntityServiceInterface<TApiProduct>
 * @extends EntityCrudServiceInterface<TApiProduct>
 */
interface ApiProductServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

}
