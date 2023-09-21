<?php

namespace Lordjoo\Apigee\Support;

use Illuminate\Http\Client\Response;
use Lordjoo\Apigee\Apigee;
use Lordjoo\Apigee\Exceptions\ErrorHandlerInterface;

/**
 * @mixin Apigee
 */
trait MakesHttpRequests
{
    protected Response $lastResponse;

    public function get(string $url, array $query = [], array $headers = [])
    {
        $response = $this->httpClient()
            ->withHeaders($headers)
            ->get($url, $query);
        if ($response->failed()) {
            $this->handleErrorResponse($response);
        }

        return $response;
    }

    public function post(string $url, array $data = [], array $headers = [])
    {
        $response = $this->httpClient()
            ->withHeaders($headers)
            ->post($url, $data);
        if ($response->failed()) {
            $this->handleErrorResponse($response);
        }

        return $response;
    }

    public function put(string $url, array $data = [], array $headers = [])
    {
        $response = $this->httpClient()
            ->withHeaders($headers)
            ->put($url, $data);
        if ($response->failed()) {
            $this->handleErrorResponse($response);
        }

        return $response;
    }

    public function delete(string $url, array $data = [], array $headers = [])
    {
        $response = $this->httpClient()
            ->withHeaders($headers)
            ->delete($url, $data);
        if ($response->failed()) {
            $this->handleErrorResponse($response);
        }

        return $response;
    }

    private function handleErrorResponse(Response $response): void
    {
        $this->lastResponse = $response;
        app(ErrorHandlerInterface::class)->handle($response);
    }
}
