<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Edge\Entities\Environment;
use Lordjoo\LaraApigee\Api\Edge\Services\EnvironmentService;
use Lordjoo\LaraApigee\Tests\Support\FakeConfigDriver;
use Lordjoo\LaraApigee\Tests\Support\FakeHttpClient;

it('can fetch environments', function () {
    $service = new EnvironmentService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'environment' => [
                [
                    'name' => 'test',
                    'displayName' => 'Test',
                ],
                [
                    'name' => 'prod',
                    'displayName' => 'Production',
                ],
            ],
        ], JSON_THROW_ON_ERROR)),
    ]), new FakeConfigDriver);

    $environments = $service->get();

    expect($environments)->toBeInstanceOf(Collection::class)
        ->and($environments)->toHaveCount(2)
        ->and($environments->first())->toBeInstanceOf(Environment::class)
        ->and($environments->map(fn (Environment $environment) => $environment->getName())->all())->toBe(['test', 'prod']);
});

it('can fetch an environment', function () {
    $service = new EnvironmentService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'name' => 'test',
            'displayName' => 'Test',
            'description' => 'Test environment',
        ], JSON_THROW_ON_ERROR)),
    ]), new FakeConfigDriver);

    $environment = $service->find('test');

    expect($environment)->toBeInstanceOf(Environment::class)
        ->and($environment->getName())->toBe('test');
});
