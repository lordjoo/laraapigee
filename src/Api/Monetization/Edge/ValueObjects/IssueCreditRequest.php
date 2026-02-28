<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects;

use InvalidArgumentException;

class IssueCreditRequest
{
    protected ?string $billingMonth = null;

    protected ?string $billingYear = null;

    protected ?string $currencyId = null;

    protected ?string $developerId = null;

    protected ?string $productId = null;

    protected null|int|float|string $transactionAmount = null;

    protected ?string $transactionNote = null;

    public function setBillingMonth(string $billingMonth): self
    {
        $this->billingMonth = trim($billingMonth);

        return $this;
    }

    public function setBillingYear(int|string $billingYear): self
    {
        if (! is_numeric($billingYear)) {
            throw new InvalidArgumentException('billingYear must be numeric.');
        }

        $this->billingYear = (string) $billingYear;

        return $this;
    }

    public function setCurrencyId(string $currencyId): self
    {
        $this->currencyId = trim($currencyId);

        return $this;
    }

    public function setDeveloperId(string $developerId): self
    {
        $this->developerId = trim($developerId);

        return $this;
    }

    public function setProductId(?string $productId): self
    {
        $this->productId = $productId !== null ? trim($productId) : null;

        return $this;
    }

    public function setTransactionAmount(int|float|string $transactionAmount): self
    {
        if (! is_numeric($transactionAmount)) {
            throw new InvalidArgumentException('transactionAmount must be numeric.');
        }

        $this->transactionAmount = $transactionAmount;

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
            'billingMonth' => $this->billingMonth,
            'billingYear' => $this->billingYear,
            'currencyId' => $this->currencyId,
            'developerId' => $this->developerId,
            'transactionAmount' => $this->transactionAmount,
            'transactionNote' => $this->transactionNote,
        ];

        foreach ($required as $field => $value) {
            if ($value === null || (is_string($value) && trim($value) === '')) {
                throw new InvalidArgumentException(sprintf('IssueCreditRequest requires [%s].', $field));
            }
        }

        $query = [
            'billingMonth' => $this->billingMonth,
            'billingYear' => $this->billingYear,
            'currencyId' => $this->currencyId,
            'developerId' => $this->developerId,
            'transactionAmount' => $this->transactionAmount,
            'transactionNote' => $this->transactionNote,
        ];

        if ($this->productId !== null && $this->productId !== '') {
            $query['productId'] = $this->productId;
        }

        return $query;
    }
}
