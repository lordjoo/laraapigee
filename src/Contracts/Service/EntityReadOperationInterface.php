<?php

namespace Lordjoo\LaraApigee\Contracts\Service;

use Lordjoo\LaraApigee\Entities\IEntity;

interface EntityReadOperationInterface
{
    /**
     * @return IEntity[]
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function get(): array;


}
