<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\BillingAdjustmentServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\BillingAdjustment;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\BillingAdjustments;

class BillingAdjustmentService extends AbstractEdgeMonetizationService implements BillingAdjustmentServiceInterface
{
    /**
     * @var array<string, string>
     */
    private const LIST_QUERY_SCHEMA = [
        'all' => 'bool',
        'size' => 'int',
        'page' => 'int',
    ];

    public function list(array $query = []): BillingAdjustments
    {
        $payload = $this->getJson('billing-adjustments', $this->validateQuery($query, self::LIST_QUERY_SCHEMA));

        return $this->denormalizeEntity($payload, BillingAdjustments::class);
    }

    public function get(array $query = []): Collection
    {
        return collect($this->list($query)->getBillingAdjustment());
    }

    public function create(BillingAdjustment $billingAdjustment): BillingAdjustment
    {
        $this->assertRequiredEntityFields(
            $billingAdjustment,
            ['adjustmentPercentageFactor', 'billingMonth', 'billingYear', 'name', 'organization'],
            'BillingAdjustment creation'
        );

        $payload = $this->postJson('billing-adjustments', $billingAdjustment, expectedStatus: [201]);

        return $this->denormalizeEntity($payload, BillingAdjustment::class);
    }

    public function find(string $billingAdjustmentId): ?BillingAdjustment
    {
        $this->assertIdentifier($billingAdjustmentId, 'billingAdjustmentId');

        $payload = $this->getJsonOrNull($this->path('billing-adjustments/{billingAdjustmentId}', [
            'billingAdjustmentId' => $billingAdjustmentId,
        ]));

        if ($payload === null) {
            return null;
        }

        return $this->denormalizeEntity($payload, BillingAdjustment::class);
    }

    public function update(string $billingAdjustmentId, BillingAdjustment $billingAdjustment): BillingAdjustment
    {
        $this->assertIdentifier($billingAdjustmentId, 'billingAdjustmentId');
        $this->assertRequiredEntityFields(
            $billingAdjustment,
            ['adjustmentPercentageFactor', 'billingMonth', 'billingYear', 'name', 'organization'],
            'BillingAdjustment update'
        );

        $payload = $this->putJson($this->path('billing-adjustments/{billingAdjustmentId}', [
            'billingAdjustmentId' => $billingAdjustmentId,
        ]), $billingAdjustment);

        return $this->denormalizeEntity($payload, BillingAdjustment::class);
    }

    public function delete(string $billingAdjustmentId): bool
    {
        $this->assertIdentifier($billingAdjustmentId, 'billingAdjustmentId');

        return $this->deleteRequest($this->path('billing-adjustments/{billingAdjustmentId}', [
            'billingAdjustmentId' => $billingAdjustmentId,
        ]), expectedStatus: [204]);
    }
}
