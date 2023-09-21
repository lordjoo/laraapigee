<?php

namespace Lordjoo\Apigee\Exceptions;

use Illuminate\Http\Client\Response;

class Handler implements ErrorHandlerInterface
{
    public function handle(Response $response)
    {
        if ($response->status() === 429) {
            throw new TooManyRequestsException($response);
        }

        if ($response->status() === 422) {
            throw new ValidationException($response->json('errors', []));
        }

        if ($response->status() === 404) {
            throw new NotFoundException($response->json('message', 'Requested resource not found'));
        }

        if ($response->status() === 400) {
            throw new BadRequestException($response->json('message'));
        }

        if ($response->json('message')) {
            throw new \Exception($response->json('message'));
        }

        $response->throw();

    }
}
