<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class RateRange extends BaseObject
{
    protected ?string $start = null;

    protected ?string $end = null;

    protected ?Money $fee = null;

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

    public function getFee(): ?Money
    {
        return $this->fee;
    }

    public function setFee(null|array|Money $fee): self
    {
        if (is_array($fee)) {
            $fee = new Money($fee);
        }

        $this->fee = $fee;

        return $this;
    }
}
