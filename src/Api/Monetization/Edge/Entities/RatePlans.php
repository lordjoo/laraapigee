<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class RatePlans extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, RatePlan> */
    protected array $ratePlan = [];

    protected ?int $total = null;

    protected ?int $totalRecords = null;

    public function getRatePlan(): array
    {
        return $this->ratePlan;
    }

    public function setRatePlan(array $ratePlan): self
    {
        $this->ratePlan = $this->castNestedEntityArray($ratePlan, RatePlan::class);

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

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
