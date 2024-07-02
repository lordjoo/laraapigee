<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Developer;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperService extends BaseService
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('developers/'))->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return Developer::class;
    }
}
