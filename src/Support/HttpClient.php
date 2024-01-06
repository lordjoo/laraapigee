<?php

namespace Lordjoo\Apigee\Support;

use Illuminate\Http\Client\PendingRequest;

class HttpClient
{
    use MakesHttpRequests;

    public PendingRequest $httpClient;

    public function __construct(
        PendingRequest $httpClient
    )
    {
        $this->httpClient = $httpClient;
    }

}
