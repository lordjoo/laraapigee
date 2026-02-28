<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\AppCredential;

/**
 * @extends \Lordjoo\LaraApigee\Contracts\Services\DeveloperAppCredentialsServiceInterface<AppCredential>
 */
interface DeveloperAppCredentialsServiceInterface extends \Lordjoo\LaraApigee\Contracts\Services\DeveloperAppCredentialsServiceInterface
{
    public function replace(string $consumerKey, AppCredential $credential): AppCredential;
}
