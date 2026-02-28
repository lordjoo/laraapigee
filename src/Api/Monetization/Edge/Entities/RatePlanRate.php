<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class RatePlanRate extends AbstractEdgeMonetizationEntity
{
    protected int|float|null $endUnit = null;

    protected ?string $id = null;

    protected int|float|null $rate = null;

    protected int|float|null $revshare = null;

    protected int|float|null $startUnit = null;

    protected ?string $type = null;

    public function getEndUnit(): int|float|null
    {
        return $this->endUnit;
    }

    public function setEndUnit(int|float|null $endUnit): self
    {
        $this->endUnit = $endUnit;

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

    public function getRate(): int|float|null
    {
        return $this->rate;
    }

    public function setRate(int|float|null $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getRevshare(): int|float|null
    {
        return $this->revshare;
    }

    public function setRevshare(int|float|null $revshare): self
    {
        $this->revshare = $revshare;

        return $this;
    }

    public function getStartUnit(): int|float|null
    {
        return $this->startUnit;
    }

    public function setStartUnit(int|float|null $startUnit): self
    {
        $this->startUnit = $startUnit;

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
