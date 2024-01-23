<?php

namespace Lordjoo\Apigee\Entities\Monetization;

class Currency extends Entity
{
    public string $id;

    public string $name;

    public string $displayName;

    public string $description;

    public string $status;

    public ?float $minimumTopupAmount;

    public bool $virtualCurrency;
}
