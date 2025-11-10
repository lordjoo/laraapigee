<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Contracts\Services\EntityCrudServiceInterface;

interface RatePlanServiceInterface extends EntityCrudServiceInterface
{
    /**
     * @return array{ratePlans: \Illuminate\Support\Collection, nextStartKey: string|null}
     */
    public function list(array $query = []): array;
}
