<?php

namespace Lordjoo\LaraApigee\Tests\Support;

use GuzzleHttp\Psr7\Response;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Psr\Http\Message\ResponseInterface;

class FakeHttpClient extends HttpClient
{
    /**
     * @var array<int, ResponseInterface>
     */
    private array $responses = [];

    /**
     * @var array<int, array{method: string, uri: string, options: array}>
     */
    public array $requests = [];

    /**
     * @param  array<int, ResponseInterface>  $responses
     */
    public function __construct(array $responses = [])
    {
        parent::__construct('https://example.test/');
        $this->responses = $responses;
    }

    public function pushResponse(ResponseInterface $response): void
    {
        $this->responses[] = $response;
    }

    public function get(string $uri, array $options = []): ResponseInterface
    {
        return $this->recordAndShift('GET', $uri, $options);
    }

    public function post(string $uri, array $options = []): ResponseInterface
    {
        return $this->recordAndShift('POST', $uri, $options);
    }

    public function put(string $uri, array $options = []): ResponseInterface
    {
        return $this->recordAndShift('PUT', $uri, $options);
    }

    public function delete(string $uri, array $options = []): ResponseInterface
    {
        return $this->recordAndShift('DELETE', $uri, $options);
    }

    private function recordAndShift(string $method, string $uri, array $options): ResponseInterface
    {
        $this->requests[] = [
            'method' => $method,
            'uri' => $uri,
            'options' => $options,
        ];

        return array_shift($this->responses) ?? new Response(200, [], '{}');
    }
}
