<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization\Services;

use Lordjoo\Apigee\Api\Edge\Monetization\Entities\Organization;

class OrganizationService extends Service
{
    /**
     * Gets the organization profile
     */
    public function getInfo(): Organization
    {
        $response = $this->client->get('')->json();

        return new Organization($response);
    }
}
