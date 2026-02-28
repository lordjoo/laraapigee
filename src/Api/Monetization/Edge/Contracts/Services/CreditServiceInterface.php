<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Transaction;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\IssueCreditRequest;

interface CreditServiceInterface
{
    public function issueToDeveloper(string $packageId, string $planId, IssueCreditRequest $request): Transaction;
}
