<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class Transactions extends AbstractEdgeMonetizationEntity
{
    protected ?int $totalRecords = null;

    /** @var array<int, Transaction> */
    protected array $transaction = [];

    public function getTotalRecords(): ?int
    {
        return $this->totalRecords;
    }

    public function setTotalRecords(?int $totalRecords): self
    {
        $this->totalRecords = $totalRecords;

        return $this;
    }

    public function getTransaction(): array
    {
        return $this->transaction;
    }

    public function setTransaction(array $transaction): self
    {
        $this->transaction = $this->castNestedEntityArray($transaction, Transaction::class);

        return $this;
    }
}
