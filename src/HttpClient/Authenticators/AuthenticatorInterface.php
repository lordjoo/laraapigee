<?php

namespace Lordjoo\LaraApigee\HttpClient\Authenticators;

interface AuthenticatorInterface
{
    public function getAuthHeader(): string;
}
