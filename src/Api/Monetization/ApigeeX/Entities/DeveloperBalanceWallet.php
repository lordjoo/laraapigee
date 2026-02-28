<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class DeveloperBalanceWallet extends BaseObject
{
    protected ?Money $balance = null;

    protected ?string $lastCreditTime = null;

    public function getBalance(): ?Money
    {
        return $this->balance;
    }

    public function setBalance(null|array|Money $balance): self
    {
        if (is_array($balance)) {
            $balance = new Money($balance);
        }

        $this->balance = $balance;

        return $this;
    }

    public function getLastCreditTime(): ?string
    {
        return $this->lastCreditTime;
    }

    public function setLastCreditTime(?string $lastCreditTime): self
    {
        $this->lastCreditTime = $lastCreditTime;

        return $this;
    }
}
