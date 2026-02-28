<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class DeveloperInfo extends AbstractEdgeMonetizationEntity
{
    protected ?string $id = null;

    protected ?string $legalName = null;

    protected ?string $name = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    public function setLegalName(?string $legalName): self
    {
        $this->legalName = $legalName;

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
