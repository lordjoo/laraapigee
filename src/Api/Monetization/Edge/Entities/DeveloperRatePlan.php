<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class DeveloperRatePlan extends AbstractEdgeMonetizationEntity
{
    protected ?string $created = null;

    protected ?Developer $developer = null;

    protected ?string $endDate = null;

    protected ?string $id = null;

    protected ?string $nextCycleStartDate = null;

    protected ?string $nextRecurringFeeDate = null;

    protected ?string $prevRecurringFeeDate = null;

    protected ?int $quotaTarget = null;

    protected ?RatePlan $ratePlan = null;

    protected ?string $startDate = null;

    protected ?string $updated = null;

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function setCreated(?string $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    public function setDeveloper(null|array|Developer $developer): self
    {
        $this->developer = $this->castNestedEntity($developer, Developer::class);

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNextCycleStartDate(): ?string
    {
        return $this->nextCycleStartDate;
    }

    public function setNextCycleStartDate(?string $nextCycleStartDate): self
    {
        $this->nextCycleStartDate = $nextCycleStartDate;

        return $this;
    }

    public function getNextRecurringFeeDate(): ?string
    {
        return $this->nextRecurringFeeDate;
    }

    public function setNextRecurringFeeDate(?string $nextRecurringFeeDate): self
    {
        $this->nextRecurringFeeDate = $nextRecurringFeeDate;

        return $this;
    }

    public function getPrevRecurringFeeDate(): ?string
    {
        return $this->prevRecurringFeeDate;
    }

    public function setPrevRecurringFeeDate(?string $prevRecurringFeeDate): self
    {
        $this->prevRecurringFeeDate = $prevRecurringFeeDate;

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

    public function getRatePlan(): ?RatePlan
    {
        return $this->ratePlan;
    }

    public function setRatePlan(null|array|RatePlan $ratePlan): self
    {
        $this->ratePlan = $this->castNestedEntity($ratePlan, RatePlan::class);

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

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    public function setUpdated(?string $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
}
