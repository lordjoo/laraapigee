<?php

namespace Lordjoo\Apigee\Entities;

use Lordjoo\Apigee\Abstract\BaseEntity;
use Lordjoo\Apigee\Entities\Properties\AppPropertiesAware;
use Lordjoo\Apigee\Entities\Properties\AttributePropertyAware;

class DeveloperApp extends BaseEntity
{
    use AppPropertiesAware,
        AttributePropertyAware;

    public string $developerId;

    public array $credentials;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $credentials = $this->credentials;
        $this->credentials = [];
        foreach ($credentials as $credential) {
            $credential['developerId'] = $this->developerId;
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
        $this->client->developerApp($this->developerId)->updateStatus($this->name, 'approve');

        return $this;
    }

    /**
     * Update app status to 'revoked'
     */
    public function revoke(): self
    {
        $this->status = 'revoked';
        $this->client->developerApp($this->developerId)->updateStatus($this->name, 'revoke');

        return $this;
    }
}
