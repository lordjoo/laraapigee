<?php

namespace Lordjoo\Apigee\Api\ApigeeX;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;
use Lordjoo\Apigee\Support\HttpClient;

/**
 * Class Apigee
 *
 * @method static ApigeeX init()
 */
class ApigeeX
{

    /**
     * @var Application|\Illuminate\Foundation\Application|ConfigReaderInterface|(ConfigReaderInterface&Application)|mixed
     */
    protected mixed $driver;
    protected HttpClient $client;
    protected PendingRequest $httpClient;

    public function __construct()
    {
        $this->driver = app(ConfigReaderInterface::class);
        $this->client = new HttpClient($this->initHttpClient());
        $this->httpClient = $this->client->httpClient;
    }

    public function __call(string $name, array $arguments)
    {
        $class = 'Lordjoo\\Apigee\\Api\\ApigeeX\\Services\\' . ucfirst($name) . 'Service';
        if (class_exists($class)) {
            return new $class($this->client);
        }
        throw new \Exception("Service $class does not exist");
    }

    private function initHttpClient(): PendingRequest
    {
        $authenticator = new Authenticator(
            key_file: $this->driver->getKeyFile()
        );

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $authenticator->getToken(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->baseUrl('https://apigee.googleapis.com/v1/organizations/' . $this->driver->getOrganization() . '/');
    }

}
