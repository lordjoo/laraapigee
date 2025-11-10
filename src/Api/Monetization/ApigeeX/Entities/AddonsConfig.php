<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class AddonsConfig extends BaseObject
{
    protected ?bool $monetizationEnabled = null;

    public function isMonetizationEnabled(): ?bool
    {
        return $this->monetizationEnabled;
    }

    public function setMonetizationEnabled(?bool $monetizationEnabled): self
    {
        $this->monetizationEnabled = $monetizationEnabled;

        return $this;
    }
}
