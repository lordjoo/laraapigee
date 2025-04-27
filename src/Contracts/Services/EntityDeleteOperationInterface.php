<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

interface EntityDeleteOperationInterface
{
    /**
     * Delete an entity by its identifier.
     *
     * @param string $identifier
     * @return bool
     * @throws \Lordjoo\LaraApigee\Exceptions\ApiException
     */
    public function delete(string $identifier): bool;
}
