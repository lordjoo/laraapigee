<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\DeveloperApp;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Contracts\Services\DeveloperAppServiceInterface;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperAppService extends BaseService implements DeveloperAppServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected string $developerId;

    public function __construct(
        HttpClient   $httpClient,
        ConfigDriver $config,
        string       $developerId
    )
    {
        parent::__construct($httpClient, $config);
        $this->developerId = $developerId;
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('developers/{developerId}/apps/'))
            ->bindParam('developerId', $this->developerId)
            ->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return DeveloperApp::class;
    }
}
