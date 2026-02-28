<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

class DeveloperSubscription extends BaseEntity
{
    protected ?string $name = null;

    protected ?string $apiproduct = null;

    protected ?string $createdAt = null;

    protected ?string $lastModifiedAt = null;

    protected ?string $startTime = null;

    protected ?string $endTime = null;

    public function getApiproduct(): ?string
    {
        return $this->apiproduct;
    }

    public function setApiproduct(?string $apiproduct): self
    {
        $this->apiproduct = $apiproduct;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLastModifiedAt(): ?string
    {
        return $this->lastModifiedAt;
    }

    public function setLastModifiedAt(?string $lastModifiedAt): self
    {
        $this->lastModifiedAt = $lastModifiedAt;

        return $this;
    }

    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    public function setStartTime(?string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->endTime;
    }

    public function setEndTime(?string $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
