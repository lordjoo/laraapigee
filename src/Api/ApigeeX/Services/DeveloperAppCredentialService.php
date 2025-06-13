<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\AppCredential;
use Lordjoo\LaraApigee\Api\Edge\Services\DeveloperAppCredentialsService as BaseDeveloperAppCredentialsService;


class DeveloperAppCredentialService extends BaseDeveloperAppCredentialsService
{

    protected function getEntityClass(): string
    {
        return AppCredential::class;
    }

}
