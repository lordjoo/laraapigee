<?php

namespace Lordjoo\LaraApigee\ConfigReaders;

class ConfigStaticDriver extends ConfigDriver
{
    protected string $organization;
    protected string $endpoint;
    protected string $userName;
    protected string $password;
    protected bool $monetizationEnabled;
    protected string $monetizationEndpoint; // added this field!
    protected string $keyFile;

    // Getters
    public function getOrganization(): string
    {
        return $this->organization;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getMonetizationEnabled(): bool
    {
        return $this->monetizationEnabled;
    }

    public function getMonetizationEndpoint(): string
    {
        return $this->monetizationEndpoint;
    }

    public function getKeyFile(): string
    {
        return $this->keyFile;
    }

    public function get(string $key): string
    {
        return match ($key) {
            'organization' => $this->getOrganization(),
            'endpoint' => $this->getEndpoint(),
            'username' => $this->getUserName(),
            'password' => $this->getPassword(),
            'monetizationEnabled' => $this->getMonetizationEnabled() ? 'true' : 'false',
            'monetizationEndpoint' => $this->getMonetizationEndpoint(),
            'keyFile' => $this->getKeyFile(),
            default => throw new \InvalidArgumentException("Invalid key: $key"),
        };
    }

    // Setters
    public function setOrganization(string $organization): self
    {
        $this->organization = $organization;
        return $this;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setMonetizationEnabled(bool $monetizationEnabled): self
    {
        $this->monetizationEnabled = $monetizationEnabled;
        return $this;
    }

    public function setMonetizationEndpoint(string $monetizationEndpoint): self
    {
        $this->monetizationEndpoint = $monetizationEndpoint;
        return $this;
    }

    public function setKeyFile(string $keyFile): self
    {
        $this->keyFile = $keyFile;
        return $this;
    }
}
