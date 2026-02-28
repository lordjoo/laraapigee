<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\AcceptRatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\DeveloperRatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\DeveloperRatePlans;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlans;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<RatePlan>
 */
interface RatePlanServiceInterface extends EntityServiceInterface
{
    public function listForOrganization(array $query = []): RatePlans;

    /**
     * @return Collection<int, RatePlan>
     */
    public function getForOrganization(array $query = []): Collection;

    public function listForPackage(string $packageId, array $query = []): RatePlans;

    /**
     * @return Collection<int, RatePlan>
     */
    public function getForPackage(string $packageId, array $query = []): Collection;

    public function createForPackage(string $packageId, RatePlan $ratePlan): RatePlan;

    public function findForPackage(string $packageId, string $planId): ?RatePlan;

    public function updateForPackage(string $packageId, string $planId, RatePlan $ratePlan): RatePlan;

    public function deleteForPackage(string $packageId, string $planId): bool;

    public function createRevision(string $packageId, string $planId, RatePlan $ratePlan): RatePlan;

    public function listAcceptedByDeveloper(string $developerEmail, array $query = []): DeveloperRatePlans;

    /**
     * @return Collection<int, DeveloperRatePlan>
     */
    public function getAcceptedByDeveloper(string $developerEmail, array $query = []): Collection;

    public function listActiveForDeveloper(string $developerEmail, array $query = []): RatePlans;

    /**
     * @return Collection<int, RatePlan>
     */
    public function getActiveForDeveloper(string $developerEmail, array $query = []): Collection;

    /**
     * @return Collection<int, DeveloperRatePlan>
     */
    public function acceptForDeveloper(string $developerEmail, AcceptRatePlan $payload): Collection;

    /**
     * @return Collection<int, DeveloperRatePlan>
     */
    public function findAcceptedForDeveloper(string $developerEmail, string $developerRatePlanId): Collection;

    public function listByDeveloperAndProduct(string $developerEmail, string $productId, array $query = []): RatePlans;

    /**
     * @return Collection<int, RatePlan>
     */
    public function getByDeveloperAndProduct(string $developerEmail, string $productId, array $query = []): Collection;
}
