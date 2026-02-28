<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\BillingAdjustment;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\BillingAdjustments;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<BillingAdjustment>
 */
interface BillingAdjustmentServiceInterface extends EntityServiceInterface
{
    public function list(array $query = []): BillingAdjustments;

    /**
     * @return Collection<int, BillingAdjustment>
     */
    public function get(array $query = []): Collection;

    public function create(BillingAdjustment $billingAdjustment): BillingAdjustment;

    public function find(string $billingAdjustmentId): ?BillingAdjustment;

    public function update(string $billingAdjustmentId, BillingAdjustment $billingAdjustment): BillingAdjustment;

    public function delete(string $billingAdjustmentId): bool;
}
