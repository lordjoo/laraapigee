<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiProduct;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiProducts;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\EligibleProducts;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<ApiProduct>
 */
interface ApiProductServiceInterface extends EntityServiceInterface
{
    public function list(array $query = []): ApiProducts;

    /**
     * @return Collection<int, ApiProduct>
     */
    public function get(array $query = []): Collection;

    public function find(string $productId): ?ApiProduct;

    public function getEligibleForCompany(string $companyId): EligibleProducts;

    /**
     * @return Collection<int, ApiProduct>
     */
    public function eligibleForCompany(string $companyId): Collection;

    public function getEligibleForDeveloper(string $developerEmail): EligibleProducts;

    /**
     * @return Collection<int, ApiProduct>
     */
    public function eligibleForDeveloper(string $developerEmail): Collection;
}
