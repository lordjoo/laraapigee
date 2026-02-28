<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects;

use InvalidArgumentException;

class RefundRequest
{
    protected ?string $monetizationPackageId = null;

    protected ?string $parentTxId = null;

    protected int|float|null $refundAmount = null;

    protected ?string $revenueType = null;

    protected ?string $transactionNote = null;

    public function setMonetizationPackageId(?string $monetizationPackageId): self
    {
        $this->monetizationPackageId = $monetizationPackageId !== null ? trim($monetizationPackageId) : null;

        return $this;
    }

    public function setParentTxId(string $parentTxId): self
    {
        $this->parentTxId = trim($parentTxId);

        return $this;
    }

    public function setRefundAmount(int|float $refundAmount): self
    {
        $this->refundAmount = $refundAmount;

        return $this;
    }

    public function setRevenueType(string $revenueType): self
    {
        $this->revenueType = trim($revenueType);

        return $this;
    }

    public function setTransactionNote(string $transactionNote): self
    {
        $this->transactionNote = trim($transactionNote);

        return $this;
    }

    /**
     * @return array<string, string|int|float>
     */
    public function toQuery(): array
    {
        $required = [
            'parentTxId' => $this->parentTxId,
            'refundAmount' => $this->refundAmount,
            'revenueType' => $this->revenueType,
            'transactionNote' => $this->transactionNote,
        ];

        foreach ($required as $field => $value) {
            if ($value === null || (is_string($value) && trim($value) === '')) {
                throw new InvalidArgumentException(sprintf('RefundRequest requires [%s].', $field));
            }
        }

        $query = [
            'parentTxId' => $this->parentTxId,
            'refundAmount' => $this->refundAmount,
            'revenueType' => $this->revenueType,
            'transactionNote' => $this->transactionNote,
        ];

        if ($this->monetizationPackageId !== null && $this->monetizationPackageId !== '') {
            $query['monetizationPackageId'] = $this->monetizationPackageId;
        }

        return $query;
    }
}
