<?php

use Lordjoo\LaraApigee\Api\Edge\Entities\ApiProduct;

it('can fetch products', function () {
    $service = \Lordjoo\LaraApigee\Facades\LaraApigee::edge()->apiProducts();
    $products = $service->get();
    // should be an array of ApiProduct objects
    $this->assertIsArray($products);
    $this->assertContainsOnlyInstancesOf(ApiProduct::class, $products);
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

    $this->assertEquals('Product 1', $product->getName());
    $this->assertEquals('Description 1', $product->getDescription());
    $this->assertEquals('Display Name 1', $product->getDisplayName());
    $this->assertEquals(['prod', 'test'], $product->getEnvironments());
    $this->assertEquals(['proxy1', 'proxy2'], $product->getProxies());
    $this->assertEquals('2', $product->getQuotaInterval());
});

it('can update product', function () {
    $service = \Lordjoo\LaraApigee\Facades\LaraApigee::edge()->apiProducts();
    /** @var ApiProduct[] $products */
    $products = $service->get();
    $this->assertIsArray($products);
    $this->assertContainsOnlyInstancesOf(ApiProduct::class, $products);
    $product = $products[0];
    $product->setDescription('New Description');
    $this->assertEquals('New Description', $product->getDescription());
});
