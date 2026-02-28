<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class AcceptRatePlan extends AbstractEdgeMonetizationEntity
{
    protected ?SimpleReference $developer = null;

    protected ?string $endDate = null;

    protected ?int $quotaTarget = null;

    protected ?SimpleReference $ratePlan = null;

    protected ?string $startDate = null;

    protected ?string $suppressWarning = null;

    protected ?bool $waveTerminationCharge = null;

    public function getDeveloper(): ?SimpleReference
    {
        return $this->developer;
    }

    public function setDeveloper(null|array|SimpleReference $developer): self
    {
        $this->developer = $this->castNestedEntity($developer, SimpleReference::class);

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getQuotaTarget(): ?int
    {
        return $this->quotaTarget;
    }

    public function setQuotaTarget(?int $quotaTarget): self
    {
        $this->quotaTarget = $quotaTarget;

        return $this;
    }

    public function getRatePlan(): ?SimpleReference
    {
        return $this->ratePlan;
    }

    public function setRatePlan(null|array|SimpleReference $ratePlan): self
    {
        $this->ratePlan = $this->castNestedEntity($ratePlan, SimpleReference::class);

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getSuppressWarning(): ?string
    {
        return $this->suppressWarning;
    }

    public function setSuppressWarning(?string $suppressWarning): self
    {
        $this->suppressWarning = $suppressWarning;

        return $this;
    }

    public function getWaveTerminationCharge(): ?bool
    {
        return $this->waveTerminationCharge;
    }

    public function setWaveTerminationCharge(?bool $waveTerminationCharge): self
    {
        $this->waveTerminationCharge = $waveTerminationCharge;

        return $this;
    }

    public function getDeveloperId(): ?string
    {
        return $this->developer?->getId();
    }

    public function getRatePlanId(): ?string
    {
        return $this->ratePlan?->getId();
    }
}
