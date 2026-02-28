<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackages;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlan;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<ApiPackage>
 */
interface ApiPackageServiceInterface extends EntityServiceInterface
{
    public function list(array $query = []): ApiPackages;

    /**
     * @return Collection<int, ApiPackage>
     */
    public function get(array $query = []): Collection;

    public function create(ApiPackage $apiPackage): ApiPackage;

    public function find(string $packageId): ?ApiPackage;

    public function delete(string $packageId): bool;

    public function listAcceptedByCompany(string $companyId, array $query = []): ApiPackages;

    /**
     * @return Collection<int, ApiPackage>
     */
    public function getAcceptedByCompany(string $companyId, array $query = []): Collection;

    public function listAcceptedByDeveloper(string $developerEmail, array $query = []): ApiPackages;

    /**
     * @return Collection<int, ApiPackage>
     */
    public function getAcceptedByDeveloper(string $developerEmail, array $query = []): Collection;

    /**
     * Add an API product to an API package.
     *
     * @param  array<int, RatePlan|array<string, mixed>>|null  $productSpecificRatePlans
     */
    public function addProduct(string $packageId, string $productId, ?array $productSpecificRatePlans = null): RatePlan;

    public function removeProduct(string $packageId, string $productId): bool;
}
