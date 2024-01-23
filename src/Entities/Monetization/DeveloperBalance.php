<?php

namespace Lordjoo\Apigee\Entities\Monetization;

class DeveloperBalance extends Entity
{
    /**
     * ID of the payment provider.
     */
    public string $id;

    /**
     * ID of the payment provider to use to reload the account, if configured.
     */
    public string $providerID;

    public float $amount;

    /**
     * Indicates whether the balance is recurring.
     */
    public bool $isRecurring;

    /**
     * Amount to add automatically to the account, if configured.
     *
     * @var bool
     */
    public float $recurringAmount;

    /**
     * Threshold that the prepaid account balance must drop below in order to trigger automatic reload, if configured.
     *
     * @var bool
     */
    public float $replenishAmount;

    public SupportedCurrency $supportedCurrency;

    /**
     * Amount used.
     */
    public float $usage;

    /**
     * Billing month.
     */
    public string $month;

    /**
     * Billing year.
     */
    public string $year;

    /**
     * Usage tax..
     */
    public float $tax;

    /**
     * Tax rate for developer.
     */
    public float $approxTaxRate;

    /**
     * Current balance in account based on current usage.
     */
    public float $currentBalance;

    /**
     * Total balance in account without subtracting current usage.
     */
    public float $currentTotalBalance;

    /**
     * Current usage.
     */
    public float $currentUsage;

    /**
     * Previous balance in account.
     */
    public float $previousBalance;

    /**
     * Sum of top ups.
     */
    public float $topups;
}
