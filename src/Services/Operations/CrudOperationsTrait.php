<?php

namespace Lordjoo\LaraApigee\Services\Operations;

trait CrudOperationsTrait
{
    use FindEntityOperationTrait;
    use LoadEntityOperationTrait;
    use CreateEntityOperationTrait;
    use UpdateEntityOperationTrait;
    use DeleteEntityOperationTrait;
}
