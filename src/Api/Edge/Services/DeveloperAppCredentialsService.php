<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\Services\DeveloperAppCredentialsServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\AppCredential;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Utility\URLTemplate;

/**
 * @extends AppCredentialsService<AppCredential>
 */
class DeveloperAppCredentialsService extends AppCredentialsService implements DeveloperAppCredentialsServiceInterface
{

    protected string $developerId;

    public function __construct(
        HttpClient $httpClient,
        ConfigDriver $config,
        string $developerId,
        string $appName
    )
    {
        parent::__construct($httpClient, $config, $appName);
        $this->developerId = $developerId;
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('developers/{developerId}/apps/{appName}/keys/'))
            ->bindParam('developerId', $this->developerId)
            ->bindParam('appName', $this->appName)
            ->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return AppCredential::class;
    }
}
