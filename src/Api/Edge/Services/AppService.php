<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\AppServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\App;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class AppService extends BaseService implements AppServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('apps/'))->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return App::class;
    }
}
