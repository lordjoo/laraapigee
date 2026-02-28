<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Edge\Entities\ApiProduct;
use Lordjoo\LaraApigee\Api\Edge\Services\ApiProductService;
use Lordjoo\LaraApigee\Tests\Support\FakeConfigDriver;
use Lordjoo\LaraApigee\Tests\Support\FakeHttpClient;

it('can fetch products', function () {
    $service = new ApiProductService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'apiProduct' => [
                [
                    'name' => 'product-1',
                    'description' => 'Description 1',
                    'displayName' => 'Display Name 1',
                    'environments' => ['prod', 'test'],
                    'proxies' => ['proxy-1'],
                ],
            ],
        ], JSON_THROW_ON_ERROR)),
    ]), new FakeConfigDriver);

    $products = $service->get();

    expect($products)->toBeInstanceOf(Collection::class)
        ->and($products)->toHaveCount(1)
        ->and($products->first())->toBeInstanceOf(ApiProduct::class)
        ->and($products->first()->getName())->toBe('product-1');
});

it('can create product', function () {
    $product = new ApiProduct([
        'name' => 'Product 1',
        'description' => 'Description 1',
        'displayName' => 'Display Name 1',
        'environments' => ['prod', 'test'],
        'proxies' => ['proxy1', 'proxy2'],
        'quotaInterval' => '2',
        'quotaTimeUnit' => 'minute',
        'quota' => '100',
    ]);

    expect($product->getName())->toBe('Product 1')
        ->and($product->getDescription())->toBe('Description 1')
        ->and($product->getDisplayName())->toBe('Display Name 1')
        ->and($product->getEnvironments())->toBe(['prod', 'test'])
        ->and($product->getProxies())->toBe(['proxy1', 'proxy2'])
        ->and($product->getQuotaInterval())->toBe('2');
});

it('can update product', function () {
    $service = new ApiProductService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'apiProduct' => [
                [
                    'name' => 'product-1',
                    'description' => 'Description 1',
                    'displayName' => 'Display Name 1',
                ],
            ],
        ], JSON_THROW_ON_ERROR)),
    ]), new FakeConfigDriver);

    /** @var Collection<int, ApiProduct> $products */
    $products = $service->get();
    $product = $products->first();
    $product->setDescription('New Description');

    expect($product->getDescription())->toBe('New Description');
});
