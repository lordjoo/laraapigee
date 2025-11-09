<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Entities\Properties;

use Lordjoo\LaraApigee\Api\Monetization\Entities\Organization;

trait OrganizationPropertyAwareTrait
{
    protected Organization $organization;

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setOrganization(Organization $organization): self
    {
        $this->organization = $organization;
        return $this;
    }
}
