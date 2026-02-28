<?php

namespace Lordjoo\LaraApigee\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotFoundException extends ApiException
{
    public function __construct(
        ?string $message,
        RequestInterface $request,
        ResponseInterface $response,
        ?\Throwable $previous = null,
        array $handlerContext = []
    ) {
        $error = $this->parseErrorResponse($response);
        $message = $message ?? $error['message'] ?? 'Not Found '.$request->getUri()->getPath();
        parent::__construct($message, $request, $response, $previous, $handlerContext);
    }
}
