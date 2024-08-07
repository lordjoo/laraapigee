<?php

namespace Lordjoo\LaraApigee\Api\Edge\Contracts;

use Lordjoo\LaraApigee\Contracts\Service\EntityCrudServiceInterface;
use Lordjoo\LaraApigee\Contracts\Service\EntityServiceInterface;

interface CompanyServiceInterface extends
    EntityServiceInterface,
    EntityCrudServiceInterface
{

    /**
     * Get all companies
     *
     * @param string $companyName
     * @return array
     */
    public function getDevelopers(string $companyName): array;

    /**
     * Add a developer to a company
     *
     * @param string $companyName
     * @param string $developerEmail
     * @param string $role
     */
    public function addDeveloperToCompany(string $companyName, string $developerEmail, string $role): array;

    /**
     * Remove a developer from a company
     *
     * @param string $companyName
     * @param string $developerEmail
     */
    public function removeDeveloperFromCompany(string $companyName, string $developerEmail): array;




}
