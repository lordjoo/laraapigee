<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Developer;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Developers;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<Developer>
 */
interface DeveloperServiceInterface extends EntityServiceInterface
{
    public function list(array $query = []): Developers;

    /**
     * @return Collection<int, Developer>
     */
    public function get(array $query = []): Collection;

    public function find(string $developerEmail): ?Developer;
}
