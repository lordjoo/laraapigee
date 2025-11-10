<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Lordjoo\LaraApigee\Contracts\Services\EntityCrudServiceInterface;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

interface ApiPackageServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{
}
