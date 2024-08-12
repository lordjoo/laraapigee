<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\DescriptionPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\StatusPropertyAwareTrait;

class Organization extends  BaseEntity
{
    use NamePropertyAwareTrait,
        DescriptionPropertyAwareTrait,
        StatusPropertyAwareTrait;

    protected ?bool $approveTrusted = null;
    protected ?bool $approveUntrusted = null;
    protected ?string $billingCycle = null;
    protected ?string $country = null;
    protected ?string $currency = null;
    protected ?bool $hasBillingAdjustment = null;
    protected ?bool $hasBroker = null;
    protected ?bool $hasSelfBilling = null;
    protected ?bool $hasSeparateInvoiceForProduct = null;
    protected ?bool $issueNettingStmt = null;
    protected ?bool $nettingStmtPerCurrency = null;
    protected ?bool $selfBillingAsExchOrg = null;
    protected bool $selfBillingForAllDev;
    protected bool $separateInvoiceForFees;
    protected string $supportedBillingType;
    protected ?string $taxEngineExternalId = null;
    protected ?string $taxModel = null;
    protected ?string $timezone = null;

    // Setters and Getters

    public function setApproveTrusted(?bool $approveTrusted): void
    {
        $this->approveTrusted = $approveTrusted;
    }

    public function getApproveTrusted(): ?bool
    {
        return $this->approveTrusted;
    }

    public function setApproveUntrusted(?bool $approveUntrusted): void
    {
        $this->approveUntrusted = $approveUntrusted;
    }

    public function getApproveUntrusted(): ?bool
    {
        return $this->approveUntrusted;
    }

    public function setBillingCycle(?string $billingCycle): void
    {
        $this->billingCycle = $billingCycle;
    }

    public function getBillingCycle(): ?string
    {
        return $this->billingCycle;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setHasBillingAdjustment(?bool $hasBillingAdjustment): void
    {
        $this->hasBillingAdjustment = $hasBillingAdjustment;
    }

    public function getHasBillingAdjustment(): ?bool
    {
        return $this->hasBillingAdjustment;
    }

    public function setHasBroker(?bool $hasBroker): void
    {
        $this->hasBroker = $hasBroker;
    }

    public function getHasBroker(): ?bool
    {
        return $this->hasBroker;
    }

    public function setHasSelfBilling(?bool $hasSelfBilling): void
    {
        $this->hasSelfBilling = $hasSelfBilling;
    }

    public function getHasSelfBilling(): ?bool
    {
        return $this->hasSelfBilling;
    }

    public function setHasSeparateInvoiceForProduct(?bool $hasSeparateInvoiceForProduct): void
    {
        $this->hasSeparateInvoiceForProduct = $hasSeparateInvoiceForProduct;
    }

    public function getHasSeparateInvoiceForProduct(): ?bool
    {
        return $this->hasSeparateInvoiceForProduct;
    }

    public function setIssueNettingStmt(?bool $issueNettingStmt): void
    {
        $this->issueNettingStmt = $issueNettingStmt;
    }

    public function getIssueNettingStmt(): ?bool
    {
        return $this->issueNettingStmt;
    }

    public function setNettingStmtPerCurrency(?bool $nettingStmtPerCurrency): void
    {
        $this->nettingStmtPerCurrency = $nettingStmtPerCurrency;
    }

    public function getNettingStmtPerCurrency(): ?bool
    {
        return $this->nettingStmtPerCurrency;
    }

    public function setSelfBillingAsExchOrg(?bool $selfBillingAsExchOrg): void
    {
        $this->selfBillingAsExchOrg = $selfBillingAsExchOrg;
    }

    public function getSelfBillingAsExchOrg(): ?bool
    {
        return $this->selfBillingAsExchOrg;
    }

    public function setSelfBillingForAllDev(bool $selfBillingForAllDev): void
    {
        $this->selfBillingForAllDev = $selfBillingForAllDev;
    }

    public function getSelfBillingForAllDev(): bool
    {
        return $this->selfBillingForAllDev;
    }

    public function setSeparateInvoiceForFees(bool $separateInvoiceForFees): void
    {
        $this->separateInvoiceForFees = $separateInvoiceForFees;
    }

    public function getSeparateInvoiceForFees(): bool
    {
        return $this->separateInvoiceForFees;
    }

    public function setSupportedBillingType(string $supportedBillingType): void
    {
        $this->supportedBillingType = $supportedBillingType;
    }

    public function getSupportedBillingType(): string
    {
        return $this->supportedBillingType;
    }

    public function setTaxEngineExternalId(?string $taxEngineExternalId): void
    {
        $this->taxEngineExternalId = $taxEngineExternalId;
    }

    public function getTaxEngineExternalId(): ?string
    {
        return $this->taxEngineExternalId;
    }

    public function setTaxModel(?string $taxModel): void
    {
        $this->taxModel = $taxModel;
    }

    public function getTaxModel(): ?string
    {
        return $this->taxModel;
    }

    public function setTimezone(?string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

}
