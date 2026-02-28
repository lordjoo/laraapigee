<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\CreditServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Transaction;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\IssueCreditRequest;

class CreditService extends AbstractEdgeMonetizationService implements CreditServiceInterface
{
    public function issueToDeveloper(string $packageId, string $planId, IssueCreditRequest $request): Transaction
    {
        $this->assertIdentifier($packageId, 'packageId');
        $this->assertIdentifier($planId, 'planId');

        $payload = $this->postJson(
            $this->path('monetization-packages/{packageId}/rate-plans/{planId}/real-currency-credit-transactions', [
                'packageId' => $packageId,
                'planId' => $planId,
            ]),
            null,
            $request->toQuery(),
            [201]
        );

        return $this->denormalizeEntity($payload, Transaction::class);
    }
}
