<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class Money extends BaseObject
{
    protected ?string $currencyCode = null;

    protected ?string $units = null;

    protected ?int $nanos = null;

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(?string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getUnits(): ?string
    {
        return $this->units;
    }

    public function setUnits(?string $units): self
    {
        $this->units = $units;

        return $this;
    }

    public function getNanos(): ?int
    {
        return $this->nanos;
    }

    public function setNanos(?int $nanos): self
    {
        $this->nanos = $nanos;

        return $this;
    }
}
