<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Proxy;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\ProxyDeployment;

interface ProxyServiceInterface
{
    /**
     * @param array<string, mixed> $query
     * @return Collection<int, Proxy>
     */
    public function get($query = []): Collection;

    /**
     * @return Collection<int, ProxyDeployment>
     */
    public function deployed(string $environment): Collection;
}
