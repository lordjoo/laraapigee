<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Contracts\CompanyServiceInterface;
use Lordjoo\LaraApigee\Api\Edge\Entities\Company;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class CompanyService extends BaseService implements CompanyServiceInterface
{
    use Operations\CrudOperationsTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * Get all companies
     *
     * @param string $companyName
     * @return array
     */
    public function getDevelopers(string $companyName): array
    {
        $path = (string) $this->getEntityPath("/$companyName/developers");
        $response = $this->getClient()->get($path);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Add a developer to a company
     *
     * @param string $companyName
     * @param string $developerEmail
     * @param string $role
     */
    public function addDeveloperToCompany(string $companyName, string $developerEmail, string $role): array
    {
        $path = (string) $this->getEntityPath("/$companyName/developers");
        $data = [
            "developer" => [[
                "email" => $developerEmail,
                "role" => $role
            ]]
        ];
        $this->getClient()->post($path, [
            'json' => $data
        ]);

        return $this->getDevelopers($companyName);
    }

    /**
     * Remove a developer from a company
     *
     * @param string $companyName
     * @param string $developerEmail
     */
    public function removeDeveloperFromCompany(string $companyName, string $developerEmail): array
    {
        $path = (string) $this->getEntityPath("/$companyName/developers/$developerEmail");
        $this->getClient()->delete($path);

        return $this->getDevelopers($companyName);
    }


    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('companies/'))->appendPath($path);
    }

    protected function getEntityClass(): string
    {
        return Company::class;
    }
}
