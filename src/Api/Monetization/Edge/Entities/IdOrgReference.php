<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class IdOrgReference extends AbstractEdgeMonetizationEntity
{
    protected ?string $id = null;

    protected ?string $orgId = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getOrgId(): ?string
    {
        return $this->orgId;
    }

    public function setOrgId(?string $orgId): self
    {
        $this->orgId = $orgId;

        return $this;
    }
}
