<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class ReportDefinition extends AbstractEdgeMonetizationEntity
{
    protected ?string $description = null;

    protected ?DeveloperInfo $developer = null;

    protected ?string $id = null;

    protected ?string $lastModified = null;

    protected ?MintCriteria $mintCriteria = null;

    protected ?string $name = null;

    protected ?Organization $organization = null;

    protected ?string $type = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDeveloper(): ?DeveloperInfo
    {
        return $this->developer;
    }

    public function setDeveloper(null|array|DeveloperInfo $developer): self
    {
        $this->developer = $this->castNestedEntity($developer, DeveloperInfo::class);

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getLastModified(): ?string
    {
        return $this->lastModified;
    }

    public function setLastModified(?string $lastModified): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    public function getMintCriteria(): ?MintCriteria
    {
        return $this->mintCriteria;
    }

    public function setMintCriteria(null|array|MintCriteria $mintCriteria): self
    {
        $this->mintCriteria = $this->castNestedEntity($mintCriteria, MintCriteria::class);

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

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(null|array|Organization $organization): self
    {
        $this->organization = $this->castNestedEntity($organization, Organization::class);

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
