<?php

namespace Lordjoo\LaraApigee\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BadRequestException extends ApiException
{
    public function __construct(
        ?string $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Throwable $previous = null,
        array $handlerContext = []
    ) {
        $error = $this->parseErrorResponse($response);
        $message = $message ?? $error['message'] ?? 'Bad Request to ['. $request->getMethod() .'] '. $request->getUri();
        parent::__construct($message, $request, $response, $previous, $handlerContext);
    }
}
