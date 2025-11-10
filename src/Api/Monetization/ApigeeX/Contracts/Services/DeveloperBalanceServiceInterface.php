<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperBalance;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\Money;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

interface DeveloperBalanceServiceInterface extends EntityServiceInterface
{
    public function get(): DeveloperBalance;

    public function credit(Money $amount, string $transactionId): DeveloperBalance;

    public function adjust(Money $adjustment): DeveloperBalance;
}
