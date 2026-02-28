<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\Developer;

/**
 * @template TDeveloper of Developer
 * @extends EntityServiceInterface<TDeveloper>
 * @extends EntityCrudServiceInterface<TDeveloper>
 */
interface DeveloperServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{
    /**
     * Set developer status.
     *
     * @param string $email
     * @param string $status "active" or "inactive"
     * @return TDeveloper|null
     */
    public function setStatus(string $email, string $status);

}
