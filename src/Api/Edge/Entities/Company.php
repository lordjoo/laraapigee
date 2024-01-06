<?php

namespace Lordjoo\Apigee\Api\Edge\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Lordjoo\Apigee\Abstract\Edge\Entity;
use Lordjoo\Apigee\Api\Edge\Entities\Properties\AttributePropertyAware;

class Company extends Entity
{
    use AttributePropertyAware;

    public string $name;

    public string $displayName;

    public string $organization;

    public string $status;

    public array $apps;

    public string $createdBy;

    public Carbon|string $createdAt;

    public string $lastModifiedBy;

    public Carbon|string $lastModifiedAt;

    /** Quick Actions  */

    /**
     * Return all apps of this company
     *
     * @return Collection<CompanyApp>
     */
    public function getApps(): Collection
    {
        return $this->client->companyApp($this->name)->get();
    }

    /**
     * Update company status to 'active'
     *
     * @return self
     */
    public function activate(): static
    {
        $this->status = 'active';
        $this->client->company()->updateStatus($this->name, 'active');

        return $this;
    }

    /**
     * Update company status to 'inactive'
     *
     * @return self
     */
    public function deactivate(): static
    {
        $this->status = 'inactive';
        $this->client->company()->updateStatus($this->name, 'inactive');

        return $this;
    }

    public function update(array $data): self
    {
        $this->client->company()->update($this->name, $data);

        return $this;
    }

    /**
     * Delete this company
     */
    public function delete(): void
    {
        $this->client->company()->delete($this->name);
    }
}
