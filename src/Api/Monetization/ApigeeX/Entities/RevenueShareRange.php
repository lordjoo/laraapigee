<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class RevenueShareRange extends BaseObject
{
    protected ?string $start = null;

    protected ?string $end = null;

    protected ?float $sharePercentage = null;

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(?string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(?string $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getSharePercentage(): ?float
    {
        return $this->sharePercentage;
    }

    public function setSharePercentage(?float $sharePercentage): self
    {
        $this->sharePercentage = $sharePercentage;

        return $this;
    }
}
