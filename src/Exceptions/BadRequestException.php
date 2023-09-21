<?php

namespace Lordjoo\Apigee\Exceptions;

class BadRequestException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message ?? 'Bad Request');
    }
}
