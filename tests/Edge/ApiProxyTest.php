<?php

use Lordjoo\Apigee\Entities\ApiProxy;

it('can fetch proxies from API', function () {
    $client = $this->app->make(\Lordjoo\Apigee\Apigee::class)->edge();
    $proxies = $client->apiProxy()->get();
    expect($proxies)->toBeInstanceOf(\Illuminate\Support\Collection::class);
});

it('response is a collection of ApiProxy', function () {
    $client = $this->app->make(\Lordjoo\Apigee\Apigee::class)->edge();
    $proxies = $client->apiProxy()->get();
    expect($proxies->first())->toBeInstanceOf(ApiProxy::class);
});
