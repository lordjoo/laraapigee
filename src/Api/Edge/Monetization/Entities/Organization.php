<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization\Entities;

class Organization extends Entity
{
    public string $id;

    public string $name;

    public string $description;

    public array $address;

    public string $status;

    public string $country;

    public string $currency;

    public string $timezone;

    public string $approveTrusted;

    public string $approveUntrusted;

    public string $billingCycle;

    public string $hasBillingAdjustment;

    public string $hasBroker;

    public string $hasSelfBilling;

    public string $hasSeparateInvoiceForProduct;

    public string $issueNettingStmt;

    public string $nettingStmtPerCurrency;

    public string $selfBillingAsExchOrg;

    public string $selfBillingForAllDev;

    public string $separateInvoiceForFees;

    public string $supportedBillingType;

    public string $taxModel;

    public string $taxEngineExternalId;
}
