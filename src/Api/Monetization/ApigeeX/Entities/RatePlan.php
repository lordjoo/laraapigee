<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

class RatePlan extends BaseEntity
{
    protected ?string $name = null;

    protected ?string $displayName = null;

    protected ?string $description = null;

    protected ?string $consumptionPricingType = null;

    /** @var RateRange[] */
    protected array $consumptionPricingRates = [];

    protected ?Money $setupFee = null;

    protected ?Money $fixedRecurringFee = null;

    protected ?int $fixedFeeFrequency = null;

    protected ?string $billingPeriod = null;

    protected ?string $currencyCode = null;

    protected ?string $paymentFundingModel = null;

    protected ?string $revenueShareType = null;

    /** @var RevenueShareRange[] */
    protected array $revenueShareRates = [];

    protected ?string $state = null;

    protected ?string $startTime = null;

    protected ?string $endTime = null;

    protected ?string $apiproduct = null;

    protected ?string $createdAt = null;

    protected ?string $lastModifiedAt = null;

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

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

    public function getConsumptionPricingType(): ?string
    {
        return $this->consumptionPricingType;
    }

    public function setConsumptionPricingType(?string $consumptionPricingType): self
    {
        $this->consumptionPricingType = $consumptionPricingType;

        return $this;
    }

    /**
     * @return RateRange[]
     */
    public function getConsumptionPricingRates(): array
    {
        return $this->consumptionPricingRates;
    }

    /**
     * @param array<int, array|RateRange> $consumptionPricingRates
     */
    public function setConsumptionPricingRates(array $consumptionPricingRates): self
    {
        $this->consumptionPricingRates = array_map(function ($rate) {
            if ($rate instanceof RateRange) {
                return $rate;
            }

            return new RateRange((array) $rate);
        }, $consumptionPricingRates);

        return $this;
    }

    public function getSetupFee(): ?Money
    {
        return $this->setupFee;
    }

    public function setSetupFee(null|array|Money $setupFee): self
    {
        if (is_array($setupFee)) {
            $setupFee = new Money($setupFee);
        }

        $this->setupFee = $setupFee;

        return $this;
    }

    public function getFixedRecurringFee(): ?Money
    {
        return $this->fixedRecurringFee;
    }

    public function setFixedRecurringFee(null|array|Money $fixedRecurringFee): self
    {
        if (is_array($fixedRecurringFee)) {
            $fixedRecurringFee = new Money($fixedRecurringFee);
        }

        $this->fixedRecurringFee = $fixedRecurringFee;

        return $this;
    }

    public function getFixedFeeFrequency(): ?int
    {
        return $this->fixedFeeFrequency;
    }

    public function setFixedFeeFrequency(?int $fixedFeeFrequency): self
    {
        $this->fixedFeeFrequency = $fixedFeeFrequency;

        return $this;
    }

    public function getBillingPeriod(): ?string
    {
        return $this->billingPeriod;
    }

    public function setBillingPeriod(?string $billingPeriod): self
    {
        $this->billingPeriod = $billingPeriod;

        return $this;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(?string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getPaymentFundingModel(): ?string
    {
        return $this->paymentFundingModel;
    }

    public function setPaymentFundingModel(?string $paymentFundingModel): self
    {
        $this->paymentFundingModel = $paymentFundingModel;

        return $this;
    }

    public function getRevenueShareType(): ?string
    {
        return $this->revenueShareType;
    }

    public function setRevenueShareType(?string $revenueShareType): self
    {
        $this->revenueShareType = $revenueShareType;

        return $this;
    }

    /**
     * @return RevenueShareRange[]
     */
    public function getRevenueShareRates(): array
    {
        return $this->revenueShareRates;
    }

    /**
     * @param array<int, array|RevenueShareRange> $revenueShareRates
     */
    public function setRevenueShareRates(array $revenueShareRates): self
    {
        $this->revenueShareRates = array_map(function ($rate) {
            if ($rate instanceof RevenueShareRange) {
                return $rate;
            }

            return new RevenueShareRange((array) $rate);
        }, $revenueShareRates);

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

    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    public function setStartTime(?string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->endTime;
    }

    public function setEndTime(?string $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getApiproduct(): ?string
    {
        return $this->apiproduct;
    }

    public function setApiproduct(?string $apiproduct): self
    {
        $this->apiproduct = $apiproduct;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLastModifiedAt(): ?string
    {
        return $this->lastModifiedAt;
    }

    public function setLastModifiedAt(?string $lastModifiedAt): self
    {
        $this->lastModifiedAt = $lastModifiedAt;

        return $this;
    }
}
