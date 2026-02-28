<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Address extends AbstractEdgeMonetizationEntity
{
    protected ?string $address1 = null;

    protected ?string $city = null;

    protected ?string $country = null;

    protected ?string $id = null;

    protected ?bool $isPrimary = null;

    protected ?string $state = null;

    protected ?string $zip = null;

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

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

    public function getIsPrimary(): ?bool
    {
        return $this->isPrimary;
    }

    public function setIsPrimary(?bool $isPrimary): self
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }
}
