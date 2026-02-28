<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class BillingAdjustments extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, BillingAdjustment> */
    protected array $billingAdjustment = [];

    protected ?int $totalRecords = null;

    public function getBillingAdjustment(): array
    {
        return $this->billingAdjustment;
    }

    public function setBillingAdjustment(array $billingAdjustment): self
    {
        $this->billingAdjustment = $this->castNestedEntityArray($billingAdjustment, BillingAdjustment::class);

        return $this;
    }

    public function getTotalRecords(): ?int
    {
        return $this->totalRecords;
    }

    public function setTotalRecords(?int $totalRecords): self
    {
        $this->totalRecords = $totalRecords;

        return $this;
    }
}
