<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class RatePlanDetails extends AbstractEdgeMonetizationEntity
{
    protected ?bool $aggregateFreemiumCounters = null;

    protected ?bool $aggregateStandardCounters = null;

    protected ?SimpleReference $currency = null;

    protected int|float|null $duration = null;

    protected ?string $durationType = null;

    protected ?int $freemiumDuration = null;

    protected ?string $freemiumDurationType = null;

    protected ?string $freemiumUnit = null;

    protected ?string $meteringType = null;

    protected int|float|null $paymentDueDays = null;

    /** @var array<int, RatePlanRate> */
    protected array $ratePlanRates = [];

    protected ?string $ratingParameter = null;

    protected ?string $ratingParameterUnit = null;

    protected ?string $revenueType = null;

    protected ?string $type = null;

    public function getAggregateFreemiumCounters(): ?bool
    {
        return $this->aggregateFreemiumCounters;
    }

    public function setAggregateFreemiumCounters(?bool $aggregateFreemiumCounters): self
    {
        $this->aggregateFreemiumCounters = $aggregateFreemiumCounters;

        return $this;
    }

    public function getAggregateStandardCounters(): ?bool
    {
        return $this->aggregateStandardCounters;
    }

    public function setAggregateStandardCounters(?bool $aggregateStandardCounters): self
    {
        $this->aggregateStandardCounters = $aggregateStandardCounters;

        return $this;
    }

    public function getCurrency(): ?SimpleReference
    {
        return $this->currency;
    }

    public function setCurrency(null|array|SimpleReference $currency): self
    {
        $this->currency = $this->castNestedEntity($currency, SimpleReference::class);

        return $this;
    }

    public function getDuration(): int|float|null
    {
        return $this->duration;
    }

    public function setDuration(int|float|null $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDurationType(): ?string
    {
        return $this->durationType;
    }

    public function setDurationType(?string $durationType): self
    {
        $this->durationType = $durationType;

        return $this;
    }

    public function getFreemiumDuration(): ?int
    {
        return $this->freemiumDuration;
    }

    public function setFreemiumDuration(?int $freemiumDuration): self
    {
        $this->freemiumDuration = $freemiumDuration;

        return $this;
    }

    public function getFreemiumDurationType(): ?string
    {
        return $this->freemiumDurationType;
    }

    public function setFreemiumDurationType(?string $freemiumDurationType): self
    {
        $this->freemiumDurationType = $freemiumDurationType;

        return $this;
    }

    public function getFreemiumUnit(): ?string
    {
        return $this->freemiumUnit;
    }

    public function setFreemiumUnit(?string $freemiumUnit): self
    {
        $this->freemiumUnit = $freemiumUnit;

        return $this;
    }

    public function getMeteringType(): ?string
    {
        return $this->meteringType;
    }

    public function setMeteringType(?string $meteringType): self
    {
        $this->meteringType = $meteringType;

        return $this;
    }

    public function getPaymentDueDays(): int|float|null
    {
        return $this->paymentDueDays;
    }

    public function setPaymentDueDays(int|float|null $paymentDueDays): self
    {
        $this->paymentDueDays = $paymentDueDays;

        return $this;
    }

    public function getRatePlanRates(): array
    {
        return $this->ratePlanRates;
    }

    public function setRatePlanRates(array $ratePlanRates): self
    {
        $this->ratePlanRates = $this->castNestedEntityArray($ratePlanRates, RatePlanRate::class);

        return $this;
    }

    public function getRatingParameter(): ?string
    {
        return $this->ratingParameter;
    }

    public function setRatingParameter(?string $ratingParameter): self
    {
        $this->ratingParameter = $ratingParameter;

        return $this;
    }

    public function getRatingParameterUnit(): ?string
    {
        return $this->ratingParameterUnit;
    }

    public function setRatingParameterUnit(?string $ratingParameterUnit): self
    {
        $this->ratingParameterUnit = $ratingParameterUnit;

        return $this;
    }

    public function getRevenueType(): ?string
    {
        return $this->revenueType;
    }

    public function setRevenueType(?string $revenueType): self
    {
        $this->revenueType = $revenueType;

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
