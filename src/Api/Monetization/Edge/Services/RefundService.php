<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\RefundServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Transaction;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\RefundRequest;

class RefundService extends AbstractEdgeMonetizationService implements RefundServiceInterface
{
    public function post(string $packageId, RefundRequest $request): Transaction
    {
        $this->assertIdentifier($packageId, 'packageId');

        $payload = $this->postJson(
            $this->path('monetization-packages/{packageId}/refund-transactions', [
                'packageId' => $packageId,
            ]),
            null,
            $request->toQuery(),
            [201]
        );

        return $this->denormalizeEntity($payload, Transaction::class);
    }
}
