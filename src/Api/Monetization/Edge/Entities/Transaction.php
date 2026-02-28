<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Transaction extends AbstractEdgeMonetizationEntity
{
    protected ?Application $application = null;

    protected int|float|null $batchSize = null;

    protected ?string $currency = null;

    protected ?DeveloperInfo $developer = null;

    protected ?string $endTime = null;

    protected ?string $environment = null;

    protected int|float|null $euroExchangeRate = null;

    protected int|float|null $gbpExchangeRate = null;

    protected ?string $id = null;

    protected ?bool $isVirtualCurrency = null;

    protected ?string $notes = null;

    protected ?string $parentId = null;

    protected ?string $pkgId = null;

    protected ?string $pkgRatePlanProductName = null;

    protected ?ApiProduct $product = null;

    protected ?string $providerTxId = null;

    protected int|float|null $rate = null;

    protected ?string $ratePlanLevel = null;

    protected int|float|null $ratedVolume = null;

    protected int|float|null $revenueShareAmount = null;

    protected ?string $startTime = null;

    protected ?string $status = null;

    protected ?string $taxModel = null;

    protected ?string $txProviderStatus = null;

    protected ?string $type = null;

    protected int|float|null $usdExchangeRate = null;

    protected ?string $utcEndTime = null;

    protected ?string $utcStartTime = null;

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(null|array|Application $application): self
    {
        $this->application = $this->castNestedEntity($application, Application::class);

        return $this;
    }

    public function getBatchSize(): int|float|null
    {
        return $this->batchSize;
    }

    public function setBatchSize(int|float|null $batchSize): self
    {
        $this->batchSize = $batchSize;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDeveloper(): ?DeveloperInfo
    {
        return $this->developer;
    }

    public function setDeveloper(null|array|DeveloperInfo $developer): self
    {
        $this->developer = $this->castNestedEntity($developer, DeveloperInfo::class);

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

    public function getEnvironment(): ?string
    {
        return $this->environment;
    }

    public function setEnvironment(?string $environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    public function getEuroExchangeRate(): int|float|null
    {
        return $this->euroExchangeRate;
    }

    public function setEuroExchangeRate(int|float|null $euroExchangeRate): self
    {
        $this->euroExchangeRate = $euroExchangeRate;

        return $this;
    }

    public function getGbpExchangeRate(): int|float|null
    {
        return $this->gbpExchangeRate;
    }

    public function setGbpExchangeRate(int|float|null $gbpExchangeRate): self
    {
        $this->gbpExchangeRate = $gbpExchangeRate;

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

    public function getIsVirtualCurrency(): ?bool
    {
        return $this->isVirtualCurrency;
    }

    public function setIsVirtualCurrency(?bool $isVirtualCurrency): self
    {
        $this->isVirtualCurrency = $isVirtualCurrency;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getPkgId(): ?string
    {
        return $this->pkgId;
    }

    public function setPkgId(?string $pkgId): self
    {
        $this->pkgId = $pkgId;

        return $this;
    }

    public function getPkgRatePlanProductName(): ?string
    {
        return $this->pkgRatePlanProductName;
    }

    public function setPkgRatePlanProductName(?string $pkgRatePlanProductName): self
    {
        $this->pkgRatePlanProductName = $pkgRatePlanProductName;

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

    public function getProviderTxId(): ?string
    {
        return $this->providerTxId;
    }

    public function setProviderTxId(?string $providerTxId): self
    {
        $this->providerTxId = $providerTxId;

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

    public function getRatePlanLevel(): ?string
    {
        return $this->ratePlanLevel;
    }

    public function setRatePlanLevel(?string $ratePlanLevel): self
    {
        $this->ratePlanLevel = $ratePlanLevel;

        return $this;
    }

    public function getRatedVolume(): int|float|null
    {
        return $this->ratedVolume;
    }

    public function setRatedVolume(int|float|null $ratedVolume): self
    {
        $this->ratedVolume = $ratedVolume;

        return $this;
    }

    public function getRevenueShareAmount(): int|float|null
    {
        return $this->revenueShareAmount;
    }

    public function setRevenueShareAmount(int|float|null $revenueShareAmount): self
    {
        $this->revenueShareAmount = $revenueShareAmount;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTaxModel(): ?string
    {
        return $this->taxModel;
    }

    public function setTaxModel(?string $taxModel): self
    {
        $this->taxModel = $taxModel;

        return $this;
    }

    public function getTxProviderStatus(): ?string
    {
        return $this->txProviderStatus;
    }

    public function setTxProviderStatus(?string $txProviderStatus): self
    {
        $this->txProviderStatus = $txProviderStatus;

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

    public function getUsdExchangeRate(): int|float|null
    {
        return $this->usdExchangeRate;
    }

    public function setUsdExchangeRate(int|float|null $usdExchangeRate): self
    {
        $this->usdExchangeRate = $usdExchangeRate;

        return $this;
    }

    public function getUtcEndTime(): ?string
    {
        return $this->utcEndTime;
    }

    public function setUtcEndTime(?string $utcEndTime): self
    {
        $this->utcEndTime = $utcEndTime;

        return $this;
    }

    public function getUtcStartTime(): ?string
    {
        return $this->utcStartTime;
    }

    public function setUtcStartTime(?string $utcStartTime): self
    {
        $this->utcStartTime = $utcStartTime;

        return $this;
    }
}
