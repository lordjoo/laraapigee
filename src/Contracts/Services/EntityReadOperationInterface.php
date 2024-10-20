<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Entities\EntityInterface;

interface EntityReadOperationInterface
{
    /**
     * @return EntityInterface[]
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function get(): array;


}
