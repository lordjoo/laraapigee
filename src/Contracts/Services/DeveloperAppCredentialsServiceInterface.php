<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\AppCredential;

/**
 * @template TCredential of AppCredential
 * @extends AppCredentialsServiceInterface<TCredential>
 */
interface DeveloperAppCredentialsServiceInterface extends AppCredentialsServiceInterface
{

}
