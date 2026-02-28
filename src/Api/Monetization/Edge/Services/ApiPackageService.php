<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackages;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Denormalizers\ApiPackageDenormalizer;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Serializer\Normalizers\ApiPackageNormalizer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use stdClass;

class ApiPackageService extends AbstractEdgeMonetizationService implements ApiPackageServiceInterface
{
    /**
     * @var array<string, string>
     */
    private const LIST_QUERY_SCHEMA = [
        'all' => 'bool',
        'size' => 'int',
        'page' => 'int',
        'monetized' => 'bool',
    ];

    /**
     * @var array<string, string>
     */
    private const ACCEPTED_LIST_QUERY_SCHEMA = [
        'current' => 'bool',
        'allAvailable' => 'bool',
    ];

    protected function createSerializer(): EntitySerializerInterface
    {
        return new EntitySerializer([
            new ApiPackageDenormalizer,
            new ApiPackageNormalizer,
        ]);
    }

    public function list(array $query = []): ApiPackages
    {
        $payload = $this->getJson('monetization-packages', $this->validateQuery($query, self::LIST_QUERY_SCHEMA));

        return $this->denormalizeEntity($payload, ApiPackages::class);
    }

    public function get(array $query = []): Collection
    {
        return collect($this->list($query)->getMonetizationPackage());
    }

    public function create(ApiPackage $apiPackage): ApiPackage
    {
        $this->assertRequiredEntityFields(
            $apiPackage,
            ['name', 'displayName', 'description', 'product', 'status'],
            'ApiPackage creation'
        );

        $payload = $this->postJson('monetization-packages', $apiPackage, expectedStatus: [201]);

        return $this->denormalizeEntity($payload, ApiPackage::class);
    }

    public function find(string $packageId): ?ApiPackage
    {
        $this->assertIdentifier($packageId, 'packageId');

        $payload = $this->getJsonOrNull($this->path('monetization-packages/{packageId}', [
            'packageId' => $packageId,
        ]));

        if ($payload === null) {
            return null;
        }

        return $this->denormalizeEntity($payload, ApiPackage::class);
    }

    public function delete(string $packageId): bool
    {
        $this->assertIdentifier($packageId, 'packageId');

        return $this->deleteRequest($this->path('monetization-packages/{packageId}', [
            'packageId' => $packageId,
        ]), expectedStatus: [204]);
    }

    public function listAcceptedByCompany(string $companyId, array $query = []): ApiPackages
    {
        $this->assertIdentifier($companyId, 'companyId');

        $payload = $this->getJson(
            $this->path('companies/{companyId}/monetization-packages', ['companyId' => $companyId]),
            $this->validateQuery($query, self::ACCEPTED_LIST_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, ApiPackages::class);
    }

    public function getAcceptedByCompany(string $companyId, array $query = []): Collection
    {
        return collect($this->listAcceptedByCompany($companyId, $query)->getMonetizationPackage());
    }

    public function listAcceptedByDeveloper(string $developerEmail, array $query = []): ApiPackages
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->getJson(
            $this->path('developers/{developerEmail}/monetization-packages', ['developerEmail' => $developerEmail]),
            $this->validateQuery($query, self::ACCEPTED_LIST_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, ApiPackages::class);
    }

    public function getAcceptedByDeveloper(string $developerEmail, array $query = []): Collection
    {
        return collect($this->listAcceptedByDeveloper($developerEmail, $query)->getMonetizationPackage());
    }

    public function addProduct(string $packageId, string $productId, ?array $productSpecificRatePlans = null): RatePlan
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($productId, 'productId');

        $payloadBody = $productSpecificRatePlans;
        if ($payloadBody === null || $payloadBody === []) {
            $payloadBody = new stdClass;
        }

        $payload = $this->postJson(
            $this->path('monetization-packages/{packageId}/products/{productId}', [
                'packageId' => $packageId,
                'productId' => $productId,
            ]),
            $payloadBody,
            expectedStatus: [200]
        );

        return $this->denormalizeEntity($payload, RatePlan::class);
    }

    public function removeProduct(string $packageId, string $productId): bool
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($productId, 'productId');

        return $this->deleteRequest($this->path('monetization-packages/{packageId}/products/{productId}', [
            'packageId' => $packageId,
            'productId' => $productId,
        ]), expectedStatus: [204]);
    }
}
