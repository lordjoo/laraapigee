<?php

namespace Lordjoo\Apigee;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\Support\MakesHttpRequests;

// PHPDoc for singltone pattern
/**
 * Class Apigee
 *
 * @method static Apigee init()
 */
class Apigee
{
    use MakesHttpRequests;

    protected ?PendingRequest $httpClient = null;

    protected string $username;

    protected string $password;

    protected string $endpoint;

    protected string $organization;
    public bool $monetizationEnabled = false;


    public function __construct(
        string $endpoint,
        string $username,
        string $password,
        string $organization,
        bool $monetizationEnabled = false
    )
    {
        $this->username = $username;
        $this->password = $password;
        $this->endpoint = $endpoint;
        $this->organization = $organization;
        $this->httpClient = $this->httpClient();
        $this->monetizationEnabled = $monetizationEnabled;
    }

    public function httpClient(): PendingRequest
    {
        return $this->httpClient ??= Http::baseUrl($this->endpoint.'/organizations/'.$this->organization.'/')
            ->withBasicAuth($this->username, $this->password);
    }

    public function edge(): Api\Edge\ApigeeEdge
    {
        return new Api\Edge\ApigeeEdge();
    }


}
