<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\EntityInterface;

/**
 * @template T of EntityInterface
 *
 * @mixin FindEntityOperationTrait<T>
 * @mixin LoadEntityOperationTrait<T>
 * @mixin CreateEntityOperationTrait<T>
 * @mixin UpdateEntityOperationTrait<T>
 * @mixin DeleteEntityOperationTrait<T>
 */
trait CrudOperationsTrait
{
    use FindEntityOperationTrait;
    use LoadEntityOperationTrait;
    use CreateEntityOperationTrait;
    use UpdateEntityOperationTrait;
    use DeleteEntityOperationTrait;
}
