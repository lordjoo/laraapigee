<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

use Lordjoo\LaraApigee\Entities\EntityInterface;

interface EntityReadOperationInterface
{
    /**
     * @return EntityInterface[]
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function get(): array;


}
