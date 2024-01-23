<?php

namespace Lordjoo\Apigee\Entities\Monetization;

class RatePlan extends Entity
{
    public string $id;

    public string $name;

    public string $displayName;

    public string $description;

    public string $type;

    public bool $customPaymentTerm;

    public bool $keepOriginalStartDate;

    public bool $isPrivate;

    public bool $published;

    public bool $prorate;

    public bool $advance;

    public int $contractDuration;

    public string $contractDurationType;

    public int $frequencyDuration;

    public int $freemiumDuration;

    public string $freemiumDurationType;

    public string $freemiumUnit;

    public string $frequencyDurationType;

    public int $recurringStartUnit;

    public float $earlyTerminationFee;

    public float $recurringFee;

    public float $setUpFee;

    public string $recurringType;

    public string $paymentDueDays;

    public string $startDate;

    public string $endDate;

    public mixed $ratePlanDetails;

    public Organization $organization;

    public Currency $currency;
}
