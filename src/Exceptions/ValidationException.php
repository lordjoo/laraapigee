<?php

namespace Lordjoo\Apigee\Exceptions;

class ValidationException extends \Exception
{
    public array $errors;

    public function __construct(array $errors = [])
    {
        $this->errors = $errors;

        parent::__construct(
            'Validation failed due to: '.json_encode($this->errors)
        );
    }
}
