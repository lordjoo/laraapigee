<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class ApiProduct extends AbstractEdgeMonetizationEntity
{
    protected ?string $customAtt1Name = null;

    protected ?string $description = null;

    protected ?string $displayName = null;

    protected ?string $id = null;

    protected ?string $name = null;

    protected ?Organization $organization = null;

    protected ?string $refundSuccessCriteria = null;

    protected ?string $status = null;

    protected ?string $transactionSuccessCriteria = null;

    public function getCustomAtt1Name(): ?string
    {
        return $this->customAtt1Name;
    }

    public function setCustomAtt1Name(?string $customAtt1Name): self
    {
        $this->customAtt1Name = $customAtt1Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

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

    public function getRefundSuccessCriteria(): ?string
    {
        return $this->refundSuccessCriteria;
    }

    public function setRefundSuccessCriteria(?string $refundSuccessCriteria): self
    {
        $this->refundSuccessCriteria = $refundSuccessCriteria;

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

    public function getTransactionSuccessCriteria(): ?string
    {
        return $this->transactionSuccessCriteria;
    }

    public function setTransactionSuccessCriteria(?string $transactionSuccessCriteria): self
    {
        $this->transactionSuccessCriteria = $transactionSuccessCriteria;

        return $this;
    }
}
