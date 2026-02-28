<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperSubscription;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<DeveloperSubscription>
 */
interface DeveloperSubscriptionServiceInterface extends EntityServiceInterface
{
    /**
     * @return array{
     *     developerSubscriptions: \Illuminate\Support\Collection<int, DeveloperSubscription>,
     *     nextStartKey: string|null
     * }
     */
    public function list(array $query = []): array;

    public function create(DeveloperSubscription $subscription): DeveloperSubscription;

    public function get(string $subscriptionId): DeveloperSubscription;

    public function expire(string $subscriptionId): DeveloperSubscription;
}
