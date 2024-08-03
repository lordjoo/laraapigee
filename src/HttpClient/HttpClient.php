<?php

namespace Lordjoo\LaraApigee\HttpClient;

use BadMethodCallException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use Lordjoo\LaraApigee\Exceptions\BadRequestException;
use Lordjoo\LaraApigee\Exceptions\NotFoundException;
use Lordjoo\LaraApigee\Exceptions\ServerErrorException;
use Lordjoo\LaraApigee\HttpClient\Authenticators\AuthenticatorInterface;
use Lordjoo\LaraApigee\HttpClient\Middlewares\ErrorHandlingMiddleware;
use Lordjoo\LaraApigee\HttpClient\Middlewares\HistoryMiddleware;


/**
 * @method \Psr\Http\Message\ResponseInterface get(string $uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface post(string $uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface put(string $uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface delete(string $uri, array $options = [])
 */
class HttpClient
{
    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @var AuthenticatorInterface
     */
    protected AuthenticatorInterface $authenticator;

    /**
     * @var Client
     */
    protected Client $client;

    public function __construct(string $baseUrl, AuthenticatorInterface $authenticator)
    {
        $this->baseUrl = $baseUrl;
        $this->authenticator = $authenticator;
        $this->initClient();
    }

    protected function initClient(): void
    {
        $stack = HandlerStack::create();
        // set up the authenticator middleware
        $stack->push(function (callable $handler) {
            return function ($request, array $options) use ($handler) {
                $request = $request->withHeader("Authorization", $this->authenticator->getAuthHeader());
                return $handler($request, $options);
            };
        });


        // create the client
        $this->client = new Client([
            "handler" => $stack,
            "base_uri" => $this->baseUrl,
            "headers" => [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
            ],
        ]);
    }


    public function __call(string $name, array $arguments)
    {
        $allowedMethods = ["get", "post", "put", "delete"];
        if (!in_array($name, $allowedMethods)) {
            throw new BadMethodCallException("Method $name not allowed");
        }
        try {
            return $this->client->$name(...$arguments);
        } catch (ClientException|ServerException $e) {
            $this->handleResponseErrors($e);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    protected function handleResponseErrors(ClientException|ServerException $e): void
    {
        $statusCode = $e->getResponse()->getStatusCode();
        if ($statusCode == 404)
            throw new NotFoundException(null, $e->getRequest(), $e->getResponse(), $e);
        if ($statusCode >= 400 && $statusCode < 500)
            throw new BadRequestException(null, $e->getRequest(), $e->getResponse(), $e);
        if ($statusCode >= 500)
            dd($e->getRequest(),$e->getRequest()->getBody()->getContents(),$e->getResponse()->getBody()->getContents());
            throw new ServerErrorException(null, $e->getRequest(), $e->getResponse(), $e);
        throw $e;
    }

}
