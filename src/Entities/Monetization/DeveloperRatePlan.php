<?php

namespace Lordjoo\Apigee\Entities\Monetization;

class DeveloperRatePlan extends Entity
{
    public string $id;

    public string $quotaTarget;

    public string $prevRecurringFeeDate;

    public string $nextRecurringFeeDate;

    public string $nextCycleStartDate;

    public string $updated;

    public string $startDate;

    public string $created;

    public Developer $developer;

    public RatePlan $ratePlan;
}
