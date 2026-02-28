<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\RatePlanServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\AcceptRatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\DeveloperRatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\DeveloperRatePlans;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlans;

class RatePlanService extends AbstractEdgeMonetizationService implements RatePlanServiceInterface
{
    /**
     * @var array<string, string>
     */
    private const PAGINATION_QUERY_SCHEMA = [
        'all' => 'bool',
        'size' => 'int',
        'page' => 'int',
    ];

    /**
     * @var array<string, string>
     */
    private const PACKAGE_LIST_QUERY_SCHEMA = [
        'current' => 'bool',
        'showPrivate' => 'bool',
        'standard' => 'bool',
    ];

    /**
     * @var array<string, string>
     */
    private const DEVELOPER_PRODUCT_LIST_QUERY_SCHEMA = [
        'showPrivate' => 'bool',
    ];

    public function listForOrganization(array $query = []): RatePlans
    {
        $payload = $this->getJson('rate-plans', $this->validateQuery($query, self::PAGINATION_QUERY_SCHEMA));

        return $this->denormalizeEntity($payload, RatePlans::class);
    }

    public function getForOrganization(array $query = []): Collection
    {
        return collect($this->listForOrganization($query)->getRatePlan());
    }

    public function listForPackage(string $packageId, array $query = []): RatePlans
    {
        $this->assertIdentifier($packageId, 'packageId');

        $payload = $this->getJson(
            $this->path('monetization-packages/{packageId}/rate-plans', ['packageId' => $packageId]),
            $this->validateQuery($query, self::PACKAGE_LIST_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, RatePlans::class);
    }

    public function getForPackage(string $packageId, array $query = []): Collection
    {
        return collect($this->listForPackage($packageId, $query)->getRatePlan());
    }

    public function createForPackage(string $packageId, RatePlan $ratePlan): RatePlan
    {
        $this->assertIdentifier($packageId, 'packageId');

        $payload = $this->postJson(
            $this->path('monetization-packages/{packageId}/rate-plans', ['packageId' => $packageId]),
            $ratePlan,
            expectedStatus: [201]
        );

        return $this->denormalizeEntity($payload, RatePlan::class);
    }

    public function findForPackage(string $packageId, string $planId): ?RatePlan
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($planId, 'planId');

        $payload = $this->getJsonOrNull($this->path(
            'monetization-packages/{packageId}/rate-plans/{planId}',
            ['packageId' => $packageId, 'planId' => $planId]
        ));

        if ($payload === null) {
            return null;
        }

        return $this->denormalizeEntity($payload, RatePlan::class);
    }

    public function updateForPackage(string $packageId, string $planId, RatePlan $ratePlan): RatePlan
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($planId, 'planId');

        $payload = $this->putJson($this->path(
            'monetization-packages/{packageId}/rate-plans/{planId}',
            ['packageId' => $packageId, 'planId' => $planId]
        ), $ratePlan);

        return $this->denormalizeEntity($payload, RatePlan::class);
    }

    public function deleteForPackage(string $packageId, string $planId): bool
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($planId, 'planId');

        return $this->deleteRequest($this->path(
            'monetization-packages/{packageId}/rate-plans/{planId}',
            ['packageId' => $packageId, 'planId' => $planId]
        ), expectedStatus: [204]);
    }

    public function createRevision(string $packageId, string $planId, RatePlan $ratePlan): RatePlan
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($planId, 'planId');

        $payload = $this->postJson($this->path(
            'monetization-packages/{packageId}/rate-plans/{planId}/revision',
            ['packageId' => $packageId, 'planId' => $planId]
        ), $ratePlan, expectedStatus: [200]);

        return $this->denormalizeEntity($payload, RatePlan::class);
    }

    public function listAcceptedByDeveloper(string $developerEmail, array $query = []): DeveloperRatePlans
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->getJson(
            $this->path('developers/{developerEmail}/developer-accepted-rateplans', ['developerEmail' => $developerEmail]),
            $this->validateQuery($query, self::PAGINATION_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, DeveloperRatePlans::class);
    }

    public function getAcceptedByDeveloper(string $developerEmail, array $query = []): Collection
    {
        return collect($this->listAcceptedByDeveloper($developerEmail, $query)->getDeveloperRatePlan());
    }

    public function listActiveForDeveloper(string $developerEmail, array $query = []): RatePlans
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->getJson(
            $this->path('developers/{developerEmail}/developer-rateplans', ['developerEmail' => $developerEmail]),
            $this->validateQuery($query, self::PAGINATION_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, RatePlans::class);
    }

    public function getActiveForDeveloper(string $developerEmail, array $query = []): Collection
    {
        return collect($this->listActiveForDeveloper($developerEmail, $query)->getRatePlan());
    }

    public function acceptForDeveloper(string $developerEmail, AcceptRatePlan $payload): Collection
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');
        $this->assertValidAcceptRatePlanPayload($payload);

        $response = $this->postJson(
            $this->path('developers/{developerEmail}/developer-rateplans', ['developerEmail' => $developerEmail]),
            $payload,
            expectedStatus: [201]
        );

        return $this->denormalizeDeveloperRatePlanCollection($response);
    }

    public function findAcceptedForDeveloper(string $developerEmail, string $developerRatePlanId): Collection
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');
        $this->assertIdentifier($developerRatePlanId, 'developerRatePlanId');

        $payload = $this->getJsonOrNull($this->path(
            'developers/{developerEmail}/developer-rateplans/{developerRatePlanId}',
            ['developerEmail' => $developerEmail, 'developerRatePlanId' => $developerRatePlanId]
        ));

        if ($payload === null) {
            return collect();
        }

        return $this->denormalizeDeveloperRatePlanCollection($payload);
    }

    public function listByDeveloperAndProduct(string $developerEmail, string $productId, array $query = []): RatePlans
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');
        $this->assertIdentifier($productId, 'productId');

        $payload = $this->getJson(
            $this->path(
                'developers/{developerEmail}/products/{productId}/rate-plan-by-developer-product',
                ['developerEmail' => $developerEmail, 'productId' => $productId]
            ),
            $this->validateQuery($query, self::DEVELOPER_PRODUCT_LIST_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, RatePlans::class);
    }

    public function getByDeveloperAndProduct(string $developerEmail, string $productId, array $query = []): Collection
    {
        return collect($this->listByDeveloperAndProduct($developerEmail, $productId, $query)->getRatePlan());
    }

    protected function assertValidAcceptRatePlanPayload(AcceptRatePlan $payload): void
    {
        $this->assertRequiredEntityFields($payload, ['developer', 'ratePlan', 'startDate'], 'AcceptRatePlan');

        if ($payload->getDeveloperId() === null || trim((string) $payload->getDeveloperId()) === '') {
            throw new InvalidArgumentException('AcceptRatePlan requires developer.id.');
        }

        if ($payload->getRatePlanId() === null || trim((string) $payload->getRatePlanId()) === '') {
            throw new InvalidArgumentException('AcceptRatePlan requires ratePlan.id.');
        }
    }

    /**
     * @param  array<string, mixed>|array<int, mixed>  $payload
     * @return Collection<int, DeveloperRatePlan>
     */
    protected function denormalizeDeveloperRatePlanCollection(array $payload): Collection
    {
        $items = [];

        if (array_is_list($payload)) {
            $items = $payload;
        } elseif (isset($payload['developerRatePlan']) && is_array($payload['developerRatePlan'])) {
            $items = $payload['developerRatePlan'];
        } else {
            // Be tolerant when Apigee returns a single object payload for endpoints the spec
            // models as arrays.
            $items = [$payload];
        }

        $flattened = [];
        foreach ($items as $item) {
            if (is_array($item) && $item !== [] && array_is_list($item) && is_array($item[0] ?? null)) {
                foreach ($item as $nestedItem) {
                    $flattened[] = $nestedItem;
                }

                continue;
            }

            $flattened[] = $item;
        }

        return $this->denormalizeEntityCollection($flattened, DeveloperRatePlan::class);
    }
}
