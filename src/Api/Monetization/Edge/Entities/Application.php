<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Application extends AbstractEdgeMonetizationEntity
{
    protected ?string $description = null;

    protected ?string $id = null;

    protected ?string $name = null;

    protected ?Organization $organization = null;

    /** @var array<int, ApiProduct> */
    protected array $product = [];

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getProduct(): array
    {
        return $this->product;
    }

    public function setProduct(array $product): self
    {
        $this->product = $this->castNestedEntityArray($product, ApiProduct::class);

        return $this;
    }
}
