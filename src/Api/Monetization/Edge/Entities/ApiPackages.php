<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class ApiPackages extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, ApiPackage> */
    protected array $monetizationPackage = [];

    protected ?int $totalRecords = null;

    public function getMonetizationPackage(): array
    {
        return $this->monetizationPackage;
    }

    public function setMonetizationPackage(array $monetizationPackage): self
    {
        $this->monetizationPackage = $this->castNestedEntityArray($monetizationPackage, ApiPackage::class);

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
