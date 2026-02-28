<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Entities\EntityInterface;

/**
 * @template TEntity of EntityInterface
 */
interface EntityReadOperationInterface
{
    /**
     * @return Collection<int, TEntity>
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function get(): Collection;


}
