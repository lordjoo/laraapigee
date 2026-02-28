<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\DeveloperApp;

/**
 * @template TDeveloperApp of DeveloperApp
 * @extends AppServiceInterface<TDeveloperApp>
 */
interface DeveloperAppServiceInterface extends AppServiceInterface
{
    public function approve(string $appId): bool;

    public function revoke(string $appId): bool;
}
