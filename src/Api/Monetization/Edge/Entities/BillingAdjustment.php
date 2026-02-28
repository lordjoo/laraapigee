<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class BillingAdjustment extends AbstractEdgeMonetizationEntity
{
    protected int|float|null $adjustmentPercentageFactor = null;

    protected ?string $billingMonth = null;

    protected ?int $billingYear = null;

    protected ?string $developerBillingType = null;

    protected ?string $id = null;

    protected ?bool $isPublished = null;

    protected ?SimpleReference $monetizationPackage = null;

    protected ?string $name = null;

    protected ?Organization $organization = null;

    protected ?ApiProduct $product = null;

    protected ?string $transactionType = null;

    public function getAdjustmentPercentageFactor(): int|float|null
    {
        return $this->adjustmentPercentageFactor;
    }

    public function setAdjustmentPercentageFactor(int|float|null $adjustmentPercentageFactor): self
    {
        $this->adjustmentPercentageFactor = $adjustmentPercentageFactor;

        return $this;
    }

    public function getBillingMonth(): ?string
    {
        return $this->billingMonth;
    }

    public function setBillingMonth(?string $billingMonth): self
    {
        $this->billingMonth = $billingMonth;

        return $this;
    }

    public function getBillingYear(): ?int
    {
        return $this->billingYear;
    }

    public function setBillingYear(?int $billingYear): self
    {
        $this->billingYear = $billingYear;

        return $this;
    }

    public function getDeveloperBillingType(): ?string
    {
        return $this->developerBillingType;
    }

    public function setDeveloperBillingType(?string $developerBillingType): self
    {
        $this->developerBillingType = $developerBillingType;

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

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getMonetizationPackage(): ?SimpleReference
    {
        return $this->monetizationPackage;
    }

    public function setMonetizationPackage(null|array|SimpleReference $monetizationPackage): self
    {
        $this->monetizationPackage = $this->castNestedEntity($monetizationPackage, SimpleReference::class);

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

    public function getProduct(): ?ApiProduct
    {
        return $this->product;
    }

    public function setProduct(null|array|ApiProduct $product): self
    {
        $this->product = $this->castNestedEntity($product, ApiProduct::class);

        return $this;
    }

    public function getTransactionType(): ?string
    {
        return $this->transactionType;
    }

    public function setTransactionType(?string $transactionType): self
    {
        $this->transactionType = $transactionType;

        return $this;
    }
}
