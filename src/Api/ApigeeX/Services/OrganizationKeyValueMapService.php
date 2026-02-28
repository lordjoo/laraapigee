<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\OrganizationKeyValueMapServiceInterface;

class OrganizationKeyValueMapService extends AbstractKeyValueMapService implements OrganizationKeyValueMapServiceInterface
{
    protected function keyValueMapCollectionPath(): string
    {
        return 'keyvaluemaps';
    }
}
