<?php

it('can fetch environments', function () {
    $service = \Lordjoo\LaraApigee\Facades\LaraApigee::edge()->environments();
    $environments = $service->get();
    $this->assertIsArray($environments);
    $this->assertTrue(count($environments) > 0);
});

it('can fetch an environment', function () {
    $service = \Lordjoo\LaraApigee\Facades\LaraApigee::edge()->environments();
    $environment = $service->get();
    $env = $environment[0];
    $environment = $service->find($env);
    $this->assertInstanceOf(\Lordjoo\LaraApigee\Api\Edge\Entities\Environment::class, $environment);
})->depends('it can fetch environments');
