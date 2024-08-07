<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\DeveloperServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\Developer;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperService extends BaseService implements  DeveloperServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * Update the status of a developer.
     *
     * @param string $email
     * @param string $status 'active' or 'inactive'
     * @return \Lordjoo\LaraApigee\Entities\IEntity|null
     */
    public function setStatus(string $email, string $status)
    {
        $this->getClient()->post(
            $this->getEntityPath()->appendPath("/{$email}")->getURL(), [
            "query" => [
                "action" => $status
            ],
            "headers" => [
                "Content-Type" => "application/octet-stream"
            ]
        ]);

        return $this->find($email);
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('developers/'))->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return Developer::class;
    }
}
