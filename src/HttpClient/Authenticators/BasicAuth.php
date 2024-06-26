<?php

namespace Lordjoo\LaraApigee\HttpClient\Authenticators;

class BasicAuth implements AuthenticatorInterface
{
    protected string $username;
    protected string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getAuthHeader(): string
    {
        return 'Basic ' . base64_encode($this->username . ':' . $this->password);
    }
}
