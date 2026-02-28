<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

class DeveloperMonetizationConfig extends BaseEntity
{
    protected ?string $name = null;

    protected ?string $billingType = null;

    public function getBillingType(): ?string
    {
        return $this->billingType;
    }

    public function setBillingType(?string $billingType): self
    {
        $this->billingType = $billingType;

        return $this;
    }
}
