<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiProductServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiProduct;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiProducts;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\EligibleProducts;

class ApiProductService extends AbstractEdgeMonetizationService implements ApiProductServiceInterface
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

    public function list(array $query = []): ApiProducts
    {
        $payload = $this->getJson('products', $this->validateQuery($query, self::LIST_QUERY_SCHEMA));

        return $this->denormalizeEntity($payload, ApiProducts::class);
    }

    public function get(array $query = []): Collection
    {
        return collect($this->list($query)->getProduct());
    }

    public function find(string $productId): ?ApiProduct
    {
        $this->assertIdentifier($productId, 'productId');

        $payload = $this->getJsonOrNull($this->path('products/{productId}', [
            'productId' => $productId,
        ]));

        if ($payload === null) {
            return null;
        }

        return $this->denormalizeEntity($payload, ApiProduct::class);
    }

    public function getEligibleForCompany(string $companyId): EligibleProducts
    {
        $this->assertIdentifier($companyId, 'companyId');

        $payload = $this->getJson($this->path('companies/{companyId}/eligible-products', [
            'companyId' => $companyId,
        ]));

        return $this->denormalizeEntity($payload, EligibleProducts::class);
    }

    public function eligibleForCompany(string $companyId): Collection
    {
        return collect($this->getEligibleForCompany($companyId)->getProduct());
    }

    public function getEligibleForDeveloper(string $developerEmail): EligibleProducts
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->getJson($this->path('developers/{developerEmail}/eligible-products', [
            'developerEmail' => $developerEmail,
        ]));

        return $this->denormalizeEntity($payload, EligibleProducts::class);
    }

    public function eligibleForDeveloper(string $developerEmail): Collection
    {
        return collect($this->getEligibleForDeveloper($developerEmail)->getProduct());
    }
}
