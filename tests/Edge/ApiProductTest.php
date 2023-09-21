<?php

use Illuminate\Support\Collection;
use Lordjoo\Apigee\Api\Edge\Entities\ApiProduct;

it('can create fetch all api products', function () {
    $client = $this->app->make(\Lordjoo\Apigee\Apigee::class)->edge();
    $products = $client->apiProduct()->get();
    expect($products)->toBeInstanceOf(Collection::class);
    expect($products->first())->toBeInstanceOf(ApiProduct::class);
});

it('can create an API product', function () {
    $client = $this->app->make(\Lordjoo\Apigee\Apigee::class)->edge();
    $product = [
        'name' => 'test-product-lara-apigee',
        'displayName' => 'Test Product Lara Apigee',
        'description' => 'Test Product Created by Lara Apigee',
        'approvalType' => 'auto',
        'attributes' => [
            [
                'name' => 'access',
                'value' => 'public',
            ],
        ],
        'apiResources' => [
            '/**',
        ],
    ];
    try {
        $product = $client->apiProduct()->create($product);
        expect($product)->toBeInstanceOf(ApiProduct::class);
    } catch (\Lordjoo\Apigee\Exceptions\BadRequestException $e) {
        $this->markTestIncomplete('This test is skipped because the product already exists');
    }
});

it('can fetch a single product by name', function () {
    $client = $this->app->make(\Lordjoo\Apigee\Apigee::class)->edge();
    try {
        $product = $client->apiProduct()->find('test-product-lara-apigee');
        expect($product)->toBeInstanceOf(ApiProduct::class);
    } catch (\Lordjoo\Apigee\Exceptions\NotFoundException $e) {
        $this->markTestIncomplete('This test is skipped because the product does not exist');
    }
});

it('can delete a product by name', function () {
    $client = $this->app->make(\Lordjoo\Apigee\Apigee::class)->edge();
    try {
        $client->apiProduct()->delete('test-product-lara-apigee');
        expect(true)->toBeTrue();
    } catch (\Lordjoo\Apigee\Exceptions\NotFoundException $e) {
        $this->markTestIncomplete('This test is skipped because the product does not exist');
    }
});
