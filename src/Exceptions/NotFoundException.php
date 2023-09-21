<?php

namespace Lordjoo\Apigee\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct(
            $message ?: 'The resource you are looking for could not be found.',
        );
    }
}
