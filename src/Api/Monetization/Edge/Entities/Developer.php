<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Developer extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, Address> */
    protected array $address = [];

    protected int|float|null $approxTaxRate = null;

    protected ?string $billingType = null;

    protected ?bool $broker = null;

    protected ?string $email = null;

    protected ?string $id = null;

    protected ?bool $isCompany = null;

    protected ?string $legalName = null;

    protected ?string $name = null;

    protected ?Organization $organization = null;

    protected ?string $registrationId = null;

    protected ?string $status = null;

    protected ?string $type = null;

    public function getAddress(): array
    {
        return $this->address;
    }

    public function setAddress(array $address): self
    {
        $this->address = $this->castNestedEntityArray($address, Address::class);

        return $this;
    }

    public function getApproxTaxRate(): int|float|null
    {
        return $this->approxTaxRate;
    }

    public function setApproxTaxRate(int|float|null $approxTaxRate): self
    {
        $this->approxTaxRate = $approxTaxRate;

        return $this;
    }

    public function getBillingType(): ?string
    {
        return $this->billingType;
    }

    public function setBillingType(?string $billingType): self
    {
        $this->billingType = $billingType;

        return $this;
    }

    public function getBroker(): ?bool
    {
        return $this->broker;
    }

    public function setBroker(?bool $broker): self
    {
        $this->broker = $broker;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getIsCompany(): ?bool
    {
        return $this->isCompany;
    }

    public function setIsCompany(?bool $isCompany): self
    {
        $this->isCompany = $isCompany;

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

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(null|array|Organization $organization): self
    {
        $this->organization = $this->castNestedEntity($organization, Organization::class);

        return $this;
    }

    public function getRegistrationId(): ?string
    {
        return $this->registrationId;
    }

    public function setRegistrationId(?string $registrationId): self
    {
        $this->registrationId = $registrationId;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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
