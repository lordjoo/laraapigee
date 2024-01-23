<?php

namespace Lordjoo\Apigee\Entities;

use Lordjoo\Apigee\Abstract\BaseEntity;
use Lordjoo\Apigee\Entities\Properties\AppPropertiesAware;
use Lordjoo\Apigee\Entities\Properties\AttributePropertyAware;

class CompanyApp extends BaseEntity
{
    use AppPropertiesAware,
        AttributePropertyAware;

    public string $companyName;

    public array $credentials;

    public function __construct(array $data)
    {
        parent::__construct($data);
        foreach ($this->credentials as $credential) {
            $credential['companyName'] = $this->companyName;
            $credential['appName'] = $this->name;
            $this->credentials[] = new AppKey($credential);
        }
    }

    /** Quick Actions  */

    /**
     * Update app status to 'approved'
     */
    public function approve(): self
    {
        $this->status = 'approved';
        $this->client->companyApp($this->companyName)->updateStatus($this->name, 'approve');

        return $this;
    }

    /**
     * Update app status to 'revoked'
     */
    public function revoke(): self
    {
        $this->status = 'revoked';
        $this->client->companyApp($this->companyName)->updateStatus($this->name, 'revoke');

        return $this;
    }
}
