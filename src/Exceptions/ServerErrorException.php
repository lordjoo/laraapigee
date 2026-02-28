<?php

namespace Lordjoo\LaraApigee\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ServerErrorException extends ApiException
{
    public function __construct(
        ?string $message,
        RequestInterface $request,
        ?ResponseInterface $response = null,
        ?\Throwable $previous = null,
        array $handlerContext = []
    ) {
        $error = $this->parseErrorResponse($response);
        $message = $message ?? $error['message'] ?? $response->getReasonPhrase() ?? 'Server Error';

        parent::__construct($message, $request, $response, $previous, $handlerContext);
    }
}
