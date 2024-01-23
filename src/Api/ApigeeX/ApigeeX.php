<?php

namespace Lordjoo\Apigee\Api\ApigeeX;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\Abstract\ApigeeApiInterface;
use Lordjoo\Apigee\Api\ApigeeX\Services\ProductService;
use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;
use Lordjoo\Apigee\Support\HttpClient;

/**
 * Class Apigee
 *
 * @method static ApigeeX init()
 */
class ApigeeX implements ApigeeApiInterface
{

    /**
     * @var Application|\Illuminate\Foundation\Application|ConfigReaderInterface|(ConfigReaderInterface&Application)|mixed
     */
    protected mixed $driver;
    protected HttpClient $client;

    public function __construct()
    {
        $this->driver = app(ConfigReaderInterface::class);
        $this->client = new HttpClient($this->initHttpClient());
    }

    public function product(): ProductService
    {
        return new ProductService($this->client);
    }

    public function proxy()
    {
        // TODO: Implement apiProxy() method.
    }

    public function developer()
    {
        // TODO: Implement developer() method.
    }

    public function developerApp(string $developerId)
    {
        // TODO: Implement developerApp() method.
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
