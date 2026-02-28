<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

class DeveloperBalance extends BaseEntity
{
    protected ?string $name = null;

    /** @var DeveloperBalanceWallet[] */
    protected array $wallets = [];

    /**
     * @return DeveloperBalanceWallet[]
     */
    public function getWallets(): array
    {
        return $this->wallets;
    }

    /**
     * @param array<int, array|DeveloperBalanceWallet> $wallets
     */
    public function setWallets(array $wallets): self
    {
        $this->wallets = array_map(function ($wallet) {
            if ($wallet instanceof DeveloperBalanceWallet) {
                return $wallet;
            }

            return new DeveloperBalanceWallet((array) $wallet);
        }, $wallets);

        return $this;
    }
}
