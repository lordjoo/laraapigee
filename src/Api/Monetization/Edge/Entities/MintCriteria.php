<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class MintCriteria extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, IdOrgReference> */
    protected array $appCriteria = [];

    protected ?string $billingMonth = null;

    protected ?string $billingYear = null;

    /** @var array<int, IdOrgReference> */
    protected array $currCriteria = [];

    protected ?string $currencyOption = null;

    /** @var array<int, IdOrgReference> */
    protected array $devCriteria = [];

    /** @var array<int, string> */
    protected array $devCustomAttribute = [];

    protected ?string $fromDate = null;

    /** @var array<int, string> */
    protected array $groupBy = [];

    /** @var array<int, string> */
    protected array $monetizationPackageIds = [];

    protected ?string $pkgCriteria = null;

    protected ?string $prevFromDate = null;

    protected ?string $prevToDate = null;

    protected ?string $prodCriteria = null;

    /** @var array<int, string> */
    protected array $productIds = [];

    /** @var array<int, string> */
    protected array $pricingTypes = [];

    /** @var array<int, string> */
    protected array $ratePlanLevels = [];

    protected ?bool $showEntityId = null;

    protected ?bool $showRevSharePct = null;

    protected ?bool $showSummary = null;

    protected ?bool $showTxDetail = null;

    protected ?bool $showTxType = null;

    protected ?string $toDate = null;

    /** @var array<int, string> */
    protected array $transactionStatus = [];

    /** @var array<int, string> */
    protected array $transactionCustomAttributes = [];

    /** @var array<int, string> */
    protected array $transactionTypes = [];

    public function getAppCriteria(): array
    {
        return $this->appCriteria;
    }

    public function setAppCriteria(array $appCriteria): self
    {
        $this->appCriteria = $this->castNestedEntityArray($appCriteria, IdOrgReference::class);

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

    public function getBillingYear(): ?string
    {
        return $this->billingYear;
    }

    public function setBillingYear(?string $billingYear): self
    {
        $this->billingYear = $billingYear;

        return $this;
    }

    public function getCurrCriteria(): array
    {
        return $this->currCriteria;
    }

    public function setCurrCriteria(array $currCriteria): self
    {
        $this->currCriteria = $this->castNestedEntityArray($currCriteria, IdOrgReference::class);

        return $this;
    }

    public function getCurrencyOption(): ?string
    {
        return $this->currencyOption;
    }

    public function setCurrencyOption(?string $currencyOption): self
    {
        $this->currencyOption = $currencyOption;

        return $this;
    }

    public function getDevCriteria(): array
    {
        return $this->devCriteria;
    }

    public function setDevCriteria(array $devCriteria): self
    {
        $this->devCriteria = $this->castNestedEntityArray($devCriteria, IdOrgReference::class);

        return $this;
    }

    public function getDevCustomAttribute(): array
    {
        return $this->devCustomAttribute;
    }

    public function setDevCustomAttribute(array $devCustomAttribute): self
    {
        $this->devCustomAttribute = $devCustomAttribute;

        return $this;
    }

    public function getFromDate(): ?string
    {
        return $this->fromDate;
    }

    public function setFromDate(?string $fromDate): self
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getGroupBy(): array
    {
        return $this->groupBy;
    }

    public function setGroupBy(array $groupBy): self
    {
        $this->groupBy = $groupBy;

        return $this;
    }

    public function getMonetizationPackageIds(): array
    {
        return $this->monetizationPackageIds;
    }

    public function setMonetizationPackageIds(array $monetizationPackageIds): self
    {
        $this->monetizationPackageIds = $monetizationPackageIds;

        return $this;
    }

    public function getPkgCriteria(): ?string
    {
        return $this->pkgCriteria;
    }

    public function setPkgCriteria(?string $pkgCriteria): self
    {
        $this->pkgCriteria = $pkgCriteria;

        return $this;
    }

    public function getPrevFromDate(): ?string
    {
        return $this->prevFromDate;
    }

    public function setPrevFromDate(?string $prevFromDate): self
    {
        $this->prevFromDate = $prevFromDate;

        return $this;
    }

    public function getPrevToDate(): ?string
    {
        return $this->prevToDate;
    }

    public function setPrevToDate(?string $prevToDate): self
    {
        $this->prevToDate = $prevToDate;

        return $this;
    }

    public function getProdCriteria(): ?string
    {
        return $this->prodCriteria;
    }

    public function setProdCriteria(?string $prodCriteria): self
    {
        $this->prodCriteria = $prodCriteria;

        return $this;
    }

    public function getProductIds(): array
    {
        return $this->productIds;
    }

    public function setProductIds(array $productIds): self
    {
        $this->productIds = $productIds;

        return $this;
    }

    public function getPricingTypes(): array
    {
        return $this->pricingTypes;
    }

    public function setPricingTypes(array $pricingTypes): self
    {
        $this->pricingTypes = $pricingTypes;

        return $this;
    }

    public function getRatePlanLevels(): array
    {
        return $this->ratePlanLevels;
    }

    public function setRatePlanLevels(array $ratePlanLevels): self
    {
        $this->ratePlanLevels = $ratePlanLevels;

        return $this;
    }

    public function getShowEntityId(): ?bool
    {
        return $this->showEntityId;
    }

    public function setShowEntityId(?bool $showEntityId): self
    {
        $this->showEntityId = $showEntityId;

        return $this;
    }

    public function getShowRevSharePct(): ?bool
    {
        return $this->showRevSharePct;
    }

    public function setShowRevSharePct(?bool $showRevSharePct): self
    {
        $this->showRevSharePct = $showRevSharePct;

        return $this;
    }

    public function getShowSummary(): ?bool
    {
        return $this->showSummary;
    }

    public function setShowSummary(?bool $showSummary): self
    {
        $this->showSummary = $showSummary;

        return $this;
    }

    public function getShowTxDetail(): ?bool
    {
        return $this->showTxDetail;
    }

    public function setShowTxDetail(?bool $showTxDetail): self
    {
        $this->showTxDetail = $showTxDetail;

        return $this;
    }

    public function getShowTxType(): ?bool
    {
        return $this->showTxType;
    }

    public function setShowTxType(?bool $showTxType): self
    {
        $this->showTxType = $showTxType;

        return $this;
    }

    public function getToDate(): ?string
    {
        return $this->toDate;
    }

    public function setToDate(?string $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getTransactionStatus(): array
    {
        return $this->transactionStatus;
    }

    public function setTransactionStatus(array $transactionStatus): self
    {
        $this->transactionStatus = $transactionStatus;

        return $this;
    }

    public function getTransactionCustomAttributes(): array
    {
        return $this->transactionCustomAttributes;
    }

    public function setTransactionCustomAttributes(array $transactionCustomAttributes): self
    {
        $this->transactionCustomAttributes = $transactionCustomAttributes;

        return $this;
    }

    public function getTransactionTypes(): array
    {
        return $this->transactionTypes;
    }

    public function setTransactionTypes(array $transactionTypes): self
    {
        $this->transactionTypes = $transactionTypes;

        return $this;
    }
}
