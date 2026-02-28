<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Organization extends AbstractEdgeMonetizationEntity
{
    protected ?bool $approvedTrusted = null;

    protected ?bool $approvedUntrusted = null;

    protected ?string $billingCycle = null;

    protected ?string $country = null;

    protected ?string $currency = null;

    protected ?string $description = null;

    protected ?bool $hasBillingAdjustment = null;

    protected ?bool $hasBroker = null;

    protected ?bool $hasSelfBilling = null;

    protected ?bool $hasSeparateInvoiceForProduct = null;

    protected ?string $id = null;

    protected ?bool $issueNettingStmt = null;

    protected ?string $logoUrl = null;

    protected ?string $name = null;

    protected ?string $netPaymentAdviceNote = null;

    protected ?bool $nettingStmtPerCurrency = null;

    protected ?string $regNo = null;

    protected ?bool $selfBillingAsExchOrg = null;

    protected ?bool $selfBillingForAllDev = null;

    protected ?bool $separateInvoiceForFees = null;

    protected ?string $status = null;

    protected ?string $supportedBillingType = null;

    protected ?string $taxEngineExternalId = null;

    protected ?string $taxModel = null;

    protected ?string $taxNexus = null;

    protected ?string $taxRegNo = null;

    protected ?string $transactionalRelayURL = null;

    protected ?string $timezone = null;

    public function getApprovedTrusted(): ?bool
    {
        return $this->approvedTrusted;
    }

    public function setApprovedTrusted(?bool $approvedTrusted): self
    {
        $this->approvedTrusted = $approvedTrusted;

        return $this;
    }

    public function getApprovedUntrusted(): ?bool
    {
        return $this->approvedUntrusted;
    }

    public function setApprovedUntrusted(?bool $approvedUntrusted): self
    {
        $this->approvedUntrusted = $approvedUntrusted;

        return $this;
    }

    public function getBillingCycle(): ?string
    {
        return $this->billingCycle;
    }

    public function setBillingCycle(?string $billingCycle): self
    {
        $this->billingCycle = $billingCycle;

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

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

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

    public function getHasBillingAdjustment(): ?bool
    {
        return $this->hasBillingAdjustment;
    }

    public function setHasBillingAdjustment(?bool $hasBillingAdjustment): self
    {
        $this->hasBillingAdjustment = $hasBillingAdjustment;

        return $this;
    }

    public function getHasBroker(): ?bool
    {
        return $this->hasBroker;
    }

    public function setHasBroker(?bool $hasBroker): self
    {
        $this->hasBroker = $hasBroker;

        return $this;
    }

    public function getHasSelfBilling(): ?bool
    {
        return $this->hasSelfBilling;
    }

    public function setHasSelfBilling(?bool $hasSelfBilling): self
    {
        $this->hasSelfBilling = $hasSelfBilling;

        return $this;
    }

    public function getHasSeparateInvoiceForProduct(): ?bool
    {
        return $this->hasSeparateInvoiceForProduct;
    }

    public function setHasSeparateInvoiceForProduct(?bool $hasSeparateInvoiceForProduct): self
    {
        $this->hasSeparateInvoiceForProduct = $hasSeparateInvoiceForProduct;

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

    public function getIssueNettingStmt(): ?bool
    {
        return $this->issueNettingStmt;
    }

    public function setIssueNettingStmt(?bool $issueNettingStmt): self
    {
        $this->issueNettingStmt = $issueNettingStmt;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

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

    public function getNetPaymentAdviceNote(): ?string
    {
        return $this->netPaymentAdviceNote;
    }

    public function setNetPaymentAdviceNote(?string $netPaymentAdviceNote): self
    {
        $this->netPaymentAdviceNote = $netPaymentAdviceNote;

        return $this;
    }

    public function getNettingStmtPerCurrency(): ?bool
    {
        return $this->nettingStmtPerCurrency;
    }

    public function setNettingStmtPerCurrency(?bool $nettingStmtPerCurrency): self
    {
        $this->nettingStmtPerCurrency = $nettingStmtPerCurrency;

        return $this;
    }

    public function getRegNo(): ?string
    {
        return $this->regNo;
    }

    public function setRegNo(?string $regNo): self
    {
        $this->regNo = $regNo;

        return $this;
    }

    public function getSelfBillingAsExchOrg(): ?bool
    {
        return $this->selfBillingAsExchOrg;
    }

    public function setSelfBillingAsExchOrg(?bool $selfBillingAsExchOrg): self
    {
        $this->selfBillingAsExchOrg = $selfBillingAsExchOrg;

        return $this;
    }

    public function getSelfBillingForAllDev(): ?bool
    {
        return $this->selfBillingForAllDev;
    }

    public function setSelfBillingForAllDev(?bool $selfBillingForAllDev): self
    {
        $this->selfBillingForAllDev = $selfBillingForAllDev;

        return $this;
    }

    public function getSeparateInvoiceForFees(): ?bool
    {
        return $this->separateInvoiceForFees;
    }

    public function setSeparateInvoiceForFees(?bool $separateInvoiceForFees): self
    {
        $this->separateInvoiceForFees = $separateInvoiceForFees;

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

    public function getSupportedBillingType(): ?string
    {
        return $this->supportedBillingType;
    }

    public function setSupportedBillingType(?string $supportedBillingType): self
    {
        $this->supportedBillingType = $supportedBillingType;

        return $this;
    }

    public function getTaxEngineExternalId(): ?string
    {
        return $this->taxEngineExternalId;
    }

    public function setTaxEngineExternalId(?string $taxEngineExternalId): self
    {
        $this->taxEngineExternalId = $taxEngineExternalId;

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

    public function getTaxNexus(): ?string
    {
        return $this->taxNexus;
    }

    public function setTaxNexus(?string $taxNexus): self
    {
        $this->taxNexus = $taxNexus;

        return $this;
    }

    public function getTaxRegNo(): ?string
    {
        return $this->taxRegNo;
    }

    public function setTaxRegNo(?string $taxRegNo): self
    {
        $this->taxRegNo = $taxRegNo;

        return $this;
    }

    public function getTransactionalRelayURL(): ?string
    {
        return $this->transactionalRelayURL;
    }

    public function setTransactionalRelayURL(?string $transactionalRelayURL): self
    {
        $this->transactionalRelayURL = $transactionalRelayURL;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }
}
