<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Developers extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, Developer> */
    protected array $developer = [];

    protected ?int $totalRecords = null;

    public function getDeveloper(): array
    {
        return $this->developer;
    }

    public function setDeveloper(array $developer): self
    {
        $this->developer = $this->castNestedEntityArray($developer, Developer::class);

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
