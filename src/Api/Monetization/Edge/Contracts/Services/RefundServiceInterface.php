<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Transaction;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\RefundRequest;

interface RefundServiceInterface
{
    public function post(string $packageId, RefundRequest $request): Transaction;
}
