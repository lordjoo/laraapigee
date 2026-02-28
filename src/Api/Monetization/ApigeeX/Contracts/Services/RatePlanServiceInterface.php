<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\RatePlan;
use Lordjoo\LaraApigee\Contracts\Services\EntityCrudServiceInterface;

/**
 * @extends EntityCrudServiceInterface<RatePlan>
 */
interface RatePlanServiceInterface extends EntityCrudServiceInterface
{
    /**
     * @return array{
     *     ratePlans: \Illuminate\Support\Collection<int, RatePlan>,
     *     nextStartKey: string|null
     * }
     */
    public function list(array $query = []): array;
}
