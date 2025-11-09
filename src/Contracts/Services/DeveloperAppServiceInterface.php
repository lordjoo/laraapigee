<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

interface DeveloperAppServiceInterface extends AppServiceInterface
{
    public function approve(string $appId): bool;

    public function revoke(string $appId): bool;
}
